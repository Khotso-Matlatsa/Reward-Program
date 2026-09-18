
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rewards</title>
</head>
	
	<body>
	






    <style>
	

<!==============combined menu================= - >
* {
    box-sizing: border-box;
}


.containers {
    max-width: 520px;
    margin: 50px auto;
    background-color: aqua;
}

.tab_triger {
}

    .tab_triger ul {
        margin: 0;
        padding: 0;
        list-style: none;
        display: flex;
    }

        .tab_triger ul li {
        }

            .tab_triger ul li label {
                position: relative;
                display: block;
                padding: 8px 15px;
                cursor: pointer;
                min-width: 100px;
                background: #e6e6e6;
                border-radius: 8px 8px 0 0;
                text-align: center;
                text-transform: uppercase;
                font-weight: 700;
            }

            .tab_triger ul li:nth-child(1) label {
                background: #f0f0f0;
            }

            .tab_triger ul li:nth-child(2) label {
                background: #e6e6e6;
            }

            .tab_triger ul li:nth-child(3) label {
                background: #d9d9d9;
            }

            .tab_triger ul li:nth-child(4) label {
                background: #ccc;
            }

.tab_container_wrap {
}

    .tab_container_wrap input {
        position: absolute;
        height: 0;
        width: 0;
        margin: 0;
        z-index: -100;
        top: -10000px;
    }

        .tab_container_wrap input:checked + .tab_content_box {
            display: block;
        }

.tab_content_box {
    background-color: aqua;
    padding: 20px;
    display: none;
}

    .tab_content_box:nth-of-type(1) {
        background-color: aqua;
    }

    .tab_content_box:nth-of-type(2) {
        background-color: aqua;
    }

    .tab_content_box:nth-of-type(3) {
        background-color: aqua;
    }

    .tab_content_box:nth-of-type(4) {
        background-color: aqua;
    }

    .tab_content_box h2 {
        margin: 0 0 20px;
    }
	

</style>

<br><br><br><br>
<section>
        <div class="containers">
		<div class="tab_triger">
			<ul>
				<li><label for="tab1">Referral</label></li>
				<li><label for="tab2">Task</label></li>
				<li><label for="tab3">Loyalty</label></li>
				<li><label for="tab4">Business</label></li>
				
			</ul>
		</div>
		<div class="tab_container_wrap">
			<input type="radio" checked id="tab1" name="1">
			<div class="tab_content_box">
				<h2>Referral rewards </h2>
				<p>You get this on the condition that you referred people and they signed up.</p>
				<p>50 people = R50</p>
				<p>80 people = R85</p>
				<p>100+ people = R120</p>
			</div>
			<input type="radio" id="tab2" name="1">
			<div class="tab_content_box">
				<h2>Task-based rewards (R200/month)</h2>
				<p>You get this reward on the condition that you completed daily tasks for a month:<br> scrolled through the products and reacted, watched all videos, subscribed to whatsappchannel, email channel and youtube channel, downloaded and explored softwares available, clicked on daily pop up ads and shared links.</p>
			</div>
			<input type="radio" id="tab3" name="1">
			<div class="tab_content_box">
				<h2>Loyalty Rewards (R500 in 6 months)</h2>
				<p>To get this reward, you should have completed task-based rewards and claimed them every month for 6 months successfully.</p>
			</div>
			<input type="radio" id="tab4" name="1">
			<div class="tab_content_box">
				<h2>Business Rewards (once off 10% profit)</h2>
				<p>To get this reward as an individual, you should refer a business which we will provide marketing services to and get 10% of the profit we make from the business you referred.<br> To get this reward as a business, you should refer a business which we will provide marketing services to and get 10% off on our advertising services.</p>
			</div>
			<input type="radio" id="tab5" name="1">
			
		</div>
	</div>

    </section>
	
	
   </body>
 </html>