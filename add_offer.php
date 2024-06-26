<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    } else {
        include 'database.php';
        $stmt = $conn->prepare("SELECT `company_name` FROM users WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($company_name);
        $stmt->fetch();
        
        if (empty($company_name)) {
            header("Location: index.php");
            exit();
        }
    }
?>
<head>
        <meta charset = "UTF-8"/>
        <title>Add offer</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href="style_add.css">
</head>
<body>
    <div id = "form_background">
    <div id = "stage">
            <label><p class = "stage checked">1</p></label><hr/>
            <label><p class = "stage">2</p></label><hr/>
            <label><p class = "stage">3</p></label>
        </div>
        <button onclick="window.history.back()" class = "button_back">Back</button>
        <form action = "add_offer_2.php" method = "POST" id = "form">
        <button type = "submit" class = "button_next">Next</button><br><br>
            <div class = "company_name">
                <input type = "text" class = "form_text_box company" name = "company_name" autocomplete="off" placeholder="Company name" value = "<?php echo $company_name?>" required></input>
            </div>

            <div class = "localization">
                <input type = "text" class = "form_text_box loc" name = "localization" autocomplete="off" placeholder="Localization" required></input>
            </div>
            
            <div class = "job_name">
                <input type = "text" class = "form_text_box title" name = "job_name" autocomplete="off" placeholder="Job title" required></input>
            </div>  

            <div class = "experience">
                <label class = "label_text">Experience</label><br>

                <label class="radio_exp">
                <input type = "radio" name = "radio_exp" class = "radio" value = "Trainee">Trainee</input><br>
                </label>

                <label class="radio_exp">
                <input type = "radio" name = "radio_exp" class = "radio" value = "Junior" required>Junior</input><br>
                </label>

                <label class="radio_exp">
                <input type = "radio" name = "radio_exp" class = "radio" value = "Mid">Mid</input><br>
                </label>

                <label class="radio_exp">
                    <input type = "radio" name = "radio_exp" class = "radio" value = "Senior">Senior</input><br>
                </label>
            </div>

            <div class = "type">
                <label class = "label_text">Type of work</label><br>

                <label class="radio_type">
                    <input type = "radio" name = "radio_type" class = "radio" value = "Practice / Internship" required>Practice / Internship</input><br>
                </label>
                    
                <label class="radio_type">
                    <input type = "radio" name = "radio_type" class = "radio" value = "Full-Time">Full-Time</input><br>
                </label>

                <label class="radio_type">
                    <input type = "radio" name = "radio_type" class = "radio" value = "Part-Time">Part-Time</input><br>
                </label>
            </div>

            <div class = "workplace">
                <label class = "label_text">Workplace</label><br>

                <label class="radio_workplace">
                    <input type = "radio" name = "radio_workplace" class = "radio" value = "Stationary" required>Stationary</input><br>
                </label>

                <label class="radio_workplace">
                    <input type = "radio" name = "radio_workplace" class = "radio" value = "Remote">Remote</input><br>
                </label>

                <label class="radio_workplace">
                    <input type = "radio" name = "radio_workplace" class = "radio" value = "Hybrid">Hybrid</input><br>
                </label>
            </div>
        </form>
    </div>
</body>