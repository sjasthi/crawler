<?php
//ini_set("display_errors","On");
//error_reporting(E_ALL);
require "header.php";
include('export_fns.php');

$exportRadio =  $_POST['langRadio'];

if(isset ($_POST["export"])) {
    if($exportRadio === 'english'){
        echo exportEngToCSV();
    }
    if($exportRadio === 'telugu'){
        exportTelToCSV();
    }
    else {
        $messagePrompt = "Nothing exported";
    }
}


?>

<div id="container">
    <div id="body">
        <div id="indexDiv">
            <div id="exportDiv">
                </p><h3>Export Results</h3>
                Select a language for export
               <br/> <form action="<?=$_SERVER['PHP_SELF']; ?>" method="POST" name="export" id="exportForm">
                    <br/> <label class="exportLabels">Language:   </label>
                    <input type="radio" name="langRadio" value="english" id="radioEng" required <?php if($_POST['langRadio'] === 'english') { print ' checked="checked"'; } ?> checked/><label class="radio">English</label>
                    <input type="radio" name="langRadio" value="telugu" id="radioTel" required <?php if($_POST['langRadio'] === 'telugu') { print ' checked="checked"'; } ?>/><label class="radio">Telugu</label>
               <br/><input type="submit" name="export" value="Export" id="exportSubmitButton">
                    </select>
                </form>
                <span class="userMessage"><br/><?php echo $messagePrompt;?></span>
            </div>
        </div>
    </div>
</div>
<?php
require "footer.php";
?>
