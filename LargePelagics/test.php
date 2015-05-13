<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Large Pelagic Database</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href='css/redmond/jquery-ui-1.10.3.custom.min.css' rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script src="js/jquery-ui-timepicker.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <h1>Large Pelagic Database</h1>
                <h2><a href="index.php">Home</a></h2>
            </div>
            <div id="main">
                <div id="menu"> <div id="menu-top">Login</div>
                    <?php
                    require_once("loginform.php");
                    require_once 'dbcon.php';
                    ?></div>
                <div id="content">
                </div>
                <?php
                //require_once("menu.php");
                ?>
                <form action="test2.php" method="post" id="insertform" name="insertform">
                    <!--                    <div id="itemRows">
                                            <select name="species[]">
                                                <option value="">Select Species</option>';
                    <?php
//                    $sql = "SELECT common FROM species";
//                    $speciesq = mysqli_query($con, $sql);
//
//                    while ($row = mysqli_fetch_array($speciesq)) {
//                        echo "<option value=\"" . $row['common'] . "\">" . $row['common'] . "</option>";
//                    }
                    ?> 
                                            </select> <br />
                                            Number: <input type="number" name="speciesnumber[]" size="4" /><br />
                                            Weight: <input type="number" name="speciesweight[]" size="4" /><br />
                                            Commercial: <select name="commercial[]"> 
                                                <option value="y">Yes</option>
                                                <option value="n">No</option>
                                            </select>
                                            <input onClick="addRow(this.form);" type="button" value="+" />
                                            <input name="speciescounter" type="hidden" value="1"/>
                                        </div>
                                        <script type="text/javascript">
                                            var rowNum = 1;
                                            var ddselc = '</select>';
                                            var frm = document.getElementById('insertform');
                    
                                            function addRow(frm) {
                                                $.post("getlist.php", function (data) {
                                                    var ddopt = '<option value="">Select Species</option>';
                                                    var ddsel = '<select name="species[]">';
                                                    for (var i = 0; i < data.length; i++) {
                                                        ddopt += '<option value="' + data[i].value + '">' + data[i].value + '</option>';
                                                    }
                                                    var row = '<p id="rowNum' + rowNum + '">' + ddsel + ddopt + ddselc + '<br />Number: <input type="text" name="speciesnumber[]" size="4" value=""><br /> Weight: <input type="text" name="speciesweight[]" value="" size="4"><br />Commercial: <select name="commercial[]"><option value="y">Yes</option><option value="n">No</option></select> <input type="button" value="-" onclick="removeRow(' + rowNum + ');"></p>';
                                                    $('#itemRows').append(row);
                                                    rowNum++;
                                                    ddopt.length = 0;
                                                    document.getElementsByName("speciescounter")[0].value = rowNum;
                                                }, "json");
                                            }
                                            function removeRow(rnum) {
                                                $('#rowNum' + rnum).remove();
                                                rowNum--;
                                                document.getElementsByName("speciescounter")[0].value= rowNum;
                                            }
                                            $("#itemRows").keyup(function (event) {
                                                if (event.keyCode == 17) {
                                                    addRow(this.form);
                                                }
                                            });
                                        </script>-->
                    <div id="AMASRows">
                        <p id="AMASrow_1"> AMAS: <input type="text" name="AMAS[]" size="10" class="amas-1"/><span class="checker-1">test</span>  <input onClick="addAMASRow(this.form);" type="button" style="float:right;" value="+" />
                            <label for="amascounter" style="float:right;" class="lblamascounter">Vessel </label><input id="amascounter" size="2" name="amascounter" type="text" value="1" readonly style="float:right;"/></p>

                    </div>
                    <div id="checker"></div>
                    <script type="text/javascript">
                        var frm = document.getElementById('insertform');
                        var AMASRowNum = 1;
                        function addAMASRow(frm) {
                            AMASRowNum++;
                            var AMASRow = '<p id="AMASrow_' + AMASRowNum + '"> AMAS: <input type="text" name="AMAS[]" size="10" class="amas-'+AMASRowNum+'"/><span class="checker-'+AMASRowNum+'"></span><input onClick="removeAMASRow(' + AMASRowNum + ');" type="button" style="float:right;" value="-" />';
                            $('#AMASRows').append(AMASRow);
                            document.getElementsByName("amascounter")[0].value = AMASRowNum;

                        }
                        function removeAMASRow(rnum) {
                            $('#AMASrow_' + rnum).remove();
                            AMASRowNum--;
                            document.getElementsByName("amascounter")[0].value = AMASRowNum;
                        }
                        $('#searchbox').keyup(function () {
                            $.post('getvessel.php', $("#searchbox").serialize(), function (data) {
                                $('#showamas').html(data);
                                if (i == 0) {
                                    $('#showamas').show("slow");
                                    i++;
                                }
                            });
                        });

                        $(function () {
                            $(document).on('keyup', "input[class|='amas']", function (e) {
                                var amas = $(this).val();
                                var cls = $(this).attr("class");
                                var split = cls.split("-");
                                var rn = split[1];
                                //alert(amas);
                                $.post("checkamas.php", {checkamas:amas}, function (data) {
                                    $(".checker-"+rn+"").html(data);
                                });
                            });
                        });

                        $(document).click(function (e) {
                            var cont = $('#showamas');
                            if (!cont.is(e.target) && cont.has(e.target).length === 0) {
                                $('#showamas').hide("slow");
                                i = 0;
                            }
                        });
                    </script>
                    <br />
                    <input name="submit" type="submit" id="button" value="Submit" onclick="return checkamas()" /> <input name="reset" type="reset" id="button" value="Reset" />
                </form>
            </div>

        </div>
        <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
    </body>
</html>