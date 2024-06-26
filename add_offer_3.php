<?php
include('database.php');
session_start();

/* Checking if user is logged in */
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$job_name = $_POST['job_name'] ?? '';
$company_name = $_POST['company_name'] ?? '';
$localization = $_POST['localization'] ?? '';
$experience = $_POST['experience'] ?? '';
$type = $_POST['type'] ?? '';
$workplace = $_POST['workplace'] ?? '';
$min_salary = $_POST['min_salary'] ?? '';
$max_salary = $_POST['max_salary'] ?? '';
$description = $_POST['description'] ?? '';
$date = date("Y-m-d");
$job_owner_id = $_SESSION['user_id'];
$salary_preview = ($max_salary == 0) ? $min_salary . " PLN" : $min_salary . " - " . $max_salary . " PLN";

if (isset($_POST['button_submit'])) {
    $queryInsert = $conn->prepare("INSERT INTO offers (`name`, `min_salary`, `max_salary`, `company`, `location`, `workplace`, `date`, `description`, `experience`, `type`, `job_owner_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $queryInsert->bind_param("siisssssssi", $job_name, $min_salary, $max_salary, $company_name, $localization, $workplace, $date, $description, $experience, $type, $job_owner_id);
    if ($queryInsert->execute()) {
        $ResumesDirectory = "Resumes/Resumes_" . $conn->insert_id;
        mkdir($ResumesDirectory, 0655);
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8"/>
    <title>Add offer</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_job_page.css">
    <link rel="stylesheet" href="style_add.css">
</head>
<body>
        <div id  = "stage_header">
            <div id="stage">
                <label><p class="stage">1</p></label><hr/>
                <label><p class="stage">2</p></label><hr/>
                <label><p class="stage checked">3</p></label>
            </div>
            <button onclick="window.history.back()" class="button_back">Back</button>
                <form method="POST">
                    <button type="submit" name="button_submit" class="button_apply">Add offer</button>
                    </div>
                    <div id="job_offer_header">
                    <input type="text" class="job_offer_page_name" value="<?= $job_name ?>" readonly name="job_name"></br>
                    <input type="text" class="job_offer_page_company" value="<?= $company_name ?>" readonly name="company_name"></br>
                    <input type="text" class="job_offer_page_location" value="<?= $localization ?>" readonly name="localization"></br>
                </div>
            
            <div id = "job_offer_middle">
                <div id="job_offer_page_salary">
                    <h2 class="job_page_salary_text">Salary:</h2>
                    <input type="text" class="salaryInput" value="<?= $salary_preview ?> / Month" readonly></input>
                </div>
                <div id="job_offer_page_description">
                    <textarea class="desc_text_area" readonly name="description" ><?= $description ?></textarea>
                </div>
            </div>
            <div id="job_offer_page_footer">
                <div class="job_offer_page_footer_level">
                    <h2 class="footer_level_text">Experience:</h2>
                    <input type="text" class="footer_level_subtext" value="<?= $experience ?>" readonly name = "experience" ></input>
                </div>
                <div class="job_offer_page_footer_date">
                    <h2 class="footer_level_text">Upload Date:</h2>
                    <input type="text" class="footer_level_subtext" value="<?= $date ?>" readonly name = "date" ></input>
                </div>
                <div class="job_offer_page_footer_time">
                    <h2 class="footer_level_text">Type of work:</h2>
                    <input type="text" class="footer_level_subtext" value="<?= $type ?>" readonly name = "type" ></input>
                </div>
                <div class="job_offer_page_footer_workplace">
                    <h2 class="footer_level_text">Workplace:</h2>
                    <input type="text" class="footer_level_subtext" value="<?= $workplace ?>" readonly name = "workplace" ></input>
                </div>
            </div>
            <input type="hidden" name="min_salary" value="<?= $min_salary ?>"></input>
            <input type="hidden" name="max_salary" value="<?= $max_salary ?>"></input>
        </form>
    </div>
</body>
</html>
