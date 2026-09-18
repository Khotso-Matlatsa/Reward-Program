<?php   
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../logins.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$isAdmin = ($_SESSION['role'] ?? '') === 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Media Center</title>
<script src="https://cdn.tailwindcss.com"></script>

<style>
body {
    background: linear-gradient(135deg, #1e3a8a, #9333ea);
}
.glass {
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,0.2);
}
</style>
</head>

<body class="min-h-screen text-white p-4">

<div class="max-w-7xl mx-auto">

<h2 class="text-3xl font-bold mb-8">🎬 Media Center</h2>

<?php if ($isAdmin): ?>
<div class="glass p-6 rounded-3xl shadow-xl mb-8">
<form method="POST" action="../upload_media.php" enctype="multipart/form-data"
class="flex flex-col md:flex-row gap-4 flex-wrap">

<input type="file" name="media" required accept="image/*,video/*"
class="bg-white/20 border p-3 rounded-xl w-full">

<input type="text" name="business_name" placeholder="Business Name"
class="bg-white/20 border p-3 rounded-xl w-full md:w-48">

<input type="number" step="0.01" name="price" placeholder="Price (M)"
class="bg-white/20 border p-3 rounded-xl w-full md:w-40">

<button type="submit"
class="bg-white text-black font-semibold px-6 py-3 rounded-xl">
Upload
</button>

</form>
</div>
<?php endif; ?>

<div id="mediaContainer"
class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"></div>

</div>

<script>
const mediaContainer = document.getElementById("mediaContainer");
const isAdmin = <?= $isAdmin ? 'true' : 'false' ?>;

/* =========================
   STATE TRACKING
========================= */
let viewedMedia = new Set();
let trackedVideos = new Set();

/* =========================
   LOAD MEDIA
========================= */
function loadMedia() {
fetch("fetch_media.php", { cache: "no-store" })
.then(r => r.text())
.then(text => {

    let data;
    try {
        data = JSON.parse(text);
    } catch (e) {
        console.error("JSON ERROR:", e);
        return;
    }

    mediaContainer.innerHTML = "";

    data.forEach(item => {

        const path = item.filepath || "";
        const type = (item.type || "").toLowerCase().trim();

        if (!path) return;

        const isVideo = type === "video" || path.endsWith(".mp4") || path.endsWith(".webm");

        let deleteButton = isAdmin
        ? `<button onclick="deleteMedia(${item.id})"
           class="bg-red-500 px-3 py-1 rounded-lg text-sm">Delete</button>`
        : "";

        mediaContainer.insertAdjacentHTML("beforeend", `
        <div class="glass p-5 rounded-3xl shadow-xl" data-id="${item.id}">

${isVideo 
? `<video controls class="w-full rounded-2xl mb-4"
    onplay="trackVideoProgress(${item.id}, this)">
    <source src="../${path}" type="video/mp4">
  </video>`
: `<img src="../${path}"
    class="w-full rounded-2xl mb-4 track-image"
    data-id="${item.id}"
    onerror="this.onerror=null; this.src='../fallback.png'; console.error('IMAGE ERROR:', '${path}')">`
}

        <p class="font-semibold">${escapeHTML(item.filename || "")}</p>

        ${item.business_name
        ? `<p class="text-yellow-300">🏢 ${escapeHTML(item.business_name)}</p>`
        : ""}

        ${!isVideo && item.price !== null
        ? `<p class="text-green-300">M${item.price}</p>`
        : ""}

        <div class="flex gap-4 mt-3">
            <button onclick="likeMedia(${item.id})"
            class="bg-pink-500 px-4 py-2 rounded-xl">❤️ Like</button>

            <span id="likes-${item.id}">${item.user_likes ?? 0}</span>

            ${deleteButton}
        </div>

        <div id="comments-${item.id}" class="mt-3"></div>

        <div class="flex gap-2 mt-2">
            <input id="comment-input-${item.id}" placeholder="Comment"
            class="bg-white/20 p-2 rounded-xl w-full">
            <button onclick="addComment(${item.id})"
            class="bg-blue-500 px-3 rounded-xl">Post</button>
        </div>

        </div>
        `);

        loadComments(item.id);
    });

    observeScroll();
});
}

/* =========================
   IMAGE TRACKING (SCROLL)
========================= */
function observeScroll(){

    const images = document.querySelectorAll(".track-image");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {

            if(entry.isIntersecting){
                const id = entry.target.dataset.id;
                trackImageView(id);
                observer.unobserve(entry.target);
            }

        });
    }, { threshold: 0.5 });

    images.forEach(img => observer.observe(img));
}

function trackImageView(id){
    if(viewedMedia.has(id)) return;

    fetch("track_view.php", {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: "media_id=" + id
    })
    .then(res => res.json())
    .then(data => {
        console.log("Image tracked:", data);
        viewedMedia.add(id);
    });
}

/* =========================
   VIDEO TRACKING (50%)
========================= */
function trackVideoProgress(id, video){

    if(trackedVideos.has(id)) return;

    function checkProgress(){
        if(!video.duration) return;

        let progress = video.currentTime / video.duration;

        if(progress >= 0.5){
            trackVideoWatch(id);
            trackedVideos.add(id);
            video.removeEventListener("timeupdate", checkProgress);
        }
    }

    video.addEventListener("timeupdate", checkProgress);
}

function trackVideoWatch(id){
    fetch("track_watching.php", {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: "media_id=" + id
    })
    .then(res => res.json())
    .then(data => {
        console.log("Video tracked:", data);
    });
}

/* =========================
   COMMENTS
========================= */
function loadComments(mediaId) {
fetch("../get_comments.php?media_id=" + mediaId)
.then(r => r.json())
.then(data => {
    let c = document.getElementById("comments-" + mediaId);
    if (!c) return;
    c.innerHTML = "";

    data.forEach(x => {
        c.innerHTML += `<p><b>${x.username}</b>: ${x.comment}</p>`;
    });
});
}

function addComment(mediaId) {
let input = document.getElementById("comment-input-" + mediaId);
if (!input.value.trim()) return;

fetch("../add_comment.php", {
method: "POST",
headers: {"Content-Type":"application/json"},
body: JSON.stringify({ media_id: mediaId, comment: input.value })
})
.then(() => {
input.value = "";
loadComments(mediaId);
});
}

/* =========================
   OTHER FUNCTIONS
========================= */
function likeMedia(id){
fetch("../like_media.php",{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({media_id:id})})
.then(r=>r.json()).then(d=>{
if(d.success) document.getElementById("likes-"+id).innerText=d.likes;
});
}

function deleteMedia(id){
if(!isAdmin) return;
if(!confirm("Delete?")) return;
fetch("delete_media.php",{method:"POST",headers:{"Content-Type":"application/x-www-form-urlencoded"},body:"id="+id})
.then(loadMedia);
}

function escapeHTML(str){
return String(str).replace(/[&<>'"]/g,t=>({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[t]));
}

document.addEventListener("DOMContentLoaded", loadMedia);
</script>

</body>
</html>