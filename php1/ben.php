<?php
// Voting eligibility nested-if example
// Test with: http://localhost/php1/index.php?age=25&citizen=yes

$min_vote_age = 18;
$age = isset($_GET['age']) ? (int)$_GET['age'] : 17;
$citizen = isset($_GET['citizen']) ? strtolower($_GET['citizen']) : 'no';
$isCitizen = in_array($citizen, ['1','yes','y','true','t'], true);

if ($age >= $min_vote_age) {
    if ($isCitizen) {
        $message = "You are $age years old and a citizen — you are eligible to vote.";
    } else {
        $message = "You are $age years old but not a citizen — you are not eligible to vote.";
    }
} else {
    $years = $min_vote_age - $age;
    $message = "You are $age years old — too young to vote. Wait $years more year(s).";
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Voting Eligibility</title></head>
<body>
  <h1>Voting Eligibility</h1>
  <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
  <p>Quick tests:
    <a href="?age=20&citizen=yes">20, citizen</a> |
    <a href="?age=20&citizen=no">20, non-citizen</a> |
    <a href="?age=16&citizen=yes">16, citizen</a>
  </p>
</body>
</html>