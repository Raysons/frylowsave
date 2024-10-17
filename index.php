<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fryer Oil Cost Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            justify-content: space-between;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .calculator, .results {
            width: 45%;
        }
        h2 {
            text-align: center;
        }
        label {
            margin: 10px 0 5px;
            display: block;
        }
        input {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .results {
            background-color: #004225;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
        }
        .results h2 {
            font-size: 24px;
        }
        .results p {
            font-size: 36px;
            margin: 10px 0;
        }
        .message {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .cost-saving-message {
        font-size: 14px;  /* Reduced font size */
        color: #fff;       /* Darker color for better readability */
        line-height: 1.5;  /* Improves readability */
        text-align: center; /* Centers the text */
        margin: 20px 0;    /* Adds some space around the text */
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="calculator">
            <h2>Fryer Oil Cost Calculator</h2>
            <form id="calculator-form">
                <label for="number-fryers">Number of Fryers:</label>
                <input type="number" id="number-fryers" name="number_fryers" required>


                <label for="pail-cost">Cost per Pail of Oil (USD):</label>
                <input type="number" id="pail-cost" name="pail_cost" required>


                <label for="pails-per-fryer">Pails per Fryer:</label>
                <input type="number" id="pails-per-fryer" name="pails_per_fryer" required>


                <label for="oil-frequency">Oil Change Frequency Per Week:</label>
                <input type="number" id="oil-frequency" name="oil_frequency" required>


                <input type="hidden" id="savings" name="savings" readonly>
            </form>
        </div>


        <div class="results">
            <h2>Annual Savings</h2>
            <p id="annual-savings">$0.00</p>
            <div class="cost-saving-message">Reduce Your Oil Expenses! Explore cost-saving options to maximize efficiency and lower expenses with our expert tips.</div>
            <button type="button" id="talk-to-agent">Talk to an Agent</button>
        </div>
    </div>


    <!-- Pop-up form -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Contact Us</h2>
            <form id="popupForm" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="mobile">Mobile Number:</label>
                <input type="text" id="mobile" name="mobile" required>


                <!-- Hidden inputs to capture calculator data -->
                <input type="hidden" name="number_fryers" id="hidden-number-fryers">
                <input type="hidden" name="pail_cost" id="hidden-pail-cost">
                <input type="hidden" name="pails_per_fryer" id="hidden-pails-per-fryer">
                <input type="hidden" name="oil_frequency" id="hidden-oil-frequency">
                <input type="hidden" name="savings" id="hidden-savings">


                <button type="submit">Submit</button>
            </form>
        </div>
    </div>


    <div id="message" class="message"></div>


    <script>
        document.getElementById('number-fryers').addEventListener('input', calculateSavings);
        document.getElementById('pail-cost').addEventListener('input', calculateSavings);
        document.getElementById('pails-per-fryer').addEventListener('input', calculateSavings);
        document.getElementById('oil-frequency').addEventListener('input', calculateSavings);


        function calculateSavings() {
            const numberOfFryers = parseFloat(document.getElementById('number-fryers').value) || 0;
            const pailCost = parseFloat(document.getElementById('pail-cost').value) || 0;
            const pailsPerFryer = parseFloat(document.getElementById('pails-per-fryer').value) || 0;
            const oilFrequency = parseFloat(document.getElementById('oil-frequency').value) || 0;


            const costWithoutFrylow = oilFrequency * pailCost * numberOfFryers * pailsPerFryer;
            const costWithFrylow = 0.5 * costWithoutFrylow;


            const savings = (costWithoutFrylow - costWithFrylow) * 52;
            document.getElementById('annual-savings').innerText = `$${savings.toFixed(2)}`;
            document.getElementById('savings').value = savings.toFixed(2);
        }


        // Pop-up modal
        document.getElementById('talk-to-agent').onclick = function() {
            document.getElementById('myModal').style.display = 'block';
        };


        document.querySelector('.close').onclick = function() {
            document.getElementById('myModal').style.display = 'none';
        };


        window.onclick = function(event) {
            if (event.target === document.getElementById('myModal')) {
                document.getElementById('myModal').style.display = 'none';
            }
        };


        // On form submission, transfer the calculator data to the hidden inputs in the modal form
        document.getElementById('popupForm').onsubmit = function() {
            document.getElementById('hidden-number-fryers').value = document.getElementById('number-fryers').value;
            document.getElementById('hidden-pail-cost').value = document.getElementById('pail-cost').value;
            document.getElementById('hidden-pails-per-fryer').value = document.getElementById('pails-per-fryer').value;
            document.getElementById('hidden-oil-frequency').value = document.getElementById('oil-frequency').value;
            document.getElementById('hidden-savings').value = document.getElementById('savings').value;
        };
    </script>


    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
        $number_fryers = isset($_POST['number_fryers']) ? $_POST['number_fryers'] : '';
        $pail_cost = isset($_POST['pail_cost']) ? $_POST['pail_cost'] : '';
        $pails_per_fryer = isset($_POST['pails_per_fryer']) ? $_POST['pails_per_fryer'] : '';
        $oil_frequency = isset($_POST['oil_frequency']) ? $_POST['oil_frequency'] : '';
        $annual_savings = isset($_POST['savings']) ? $_POST['savings'] : '';


        if (!empty($email) && !empty($mobile)) {
            $url = "https://tapeapp.com/api/catch/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ3b3JrZmxvd0RlZklkIjoxNzYwODIsIm9yZ2FuaXphdGlvbklkIjoyMDI4LCJzY29wZSI6Indrcl92MSJ9.Gcyw0veIYANwGlVlPTrsmm2fDSrKBJzd3c_URPnBvPE";


            $data = [
                'email' => $email,
                'mobile' => $mobile,
                'number_fryers' => $number_fryers,
                'pail_cost' => $pail_cost,
                'pails_per_fryer' => $pails_per_fryer,
                'oil_frequency' => $oil_frequency,
                'annual_savings' => $annual_savings
            ];


            $options = [
                'http' => [
                    'header'  => "Content-type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => json_encode($data),
                ],
            ];


            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);


            if ($result === FALSE) {
                echo '<div class="message error">There was an error submitting the form.</div>';
            } else {
                echo '<div class="message success">Data successfully sent to Tape!</div>';
            }
        } else {
            echo '<div class="message error">Please enter valid email and mobile number.</div>';
        }
    }
    ?>
</body>
</html>
