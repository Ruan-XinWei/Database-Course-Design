<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>学生课外活动成果统计系统</title>
    <link rel="stylesheet" href="../../../style/reset.css">
    <link rel="stylesheet" href="../../../style/main_info.css">
    <script src="../../../script/getUrlParam.js"></script>
    <script src="../../../script/myFunction.js"></script>
    <script src="../../../script/main_info.js"></script>
    <?php
    include_once "../../db-inc.php";
    $link = db_connect();
    $url_user_id = geturl_string();
    ?>
</head>

<body>
    <header class="header">
        <div class="header_main clearfix">
            <div class="img">
                <a href="javascript:;">
                    <img src="../../../img/wust_logo(no background).jpg" alt="wust_logo">
                </a>
            </div>
            <div class="info">
                <div class="div_name">
                    <span>姓名：</span>
                    <span id="name"></span>
                </div>
                <div class="div_id">
                    <span>学号：</span>
                    <span id="id"></span>
                </div>
            </div>
        </div>
    </header>
    <div class="title">
        <div class="title_main">
            <span>学生课外活动成果统计系统</span>
        </div>
    </div>
    <div class="top_list">
        <ul class="top_list_main clearfix">
            <li class="personal_center">
                <a href="../personal_center_page/main_info_student?<?php echo $url_user_id ?>">
                    <span>个人中心</span>
                </a>
            </li>
            <li class="select_information">
                <a href="../select_page/select_student_student.php?<?php echo $url_user_id ?>">
                    <span>查询信息</span>
                </a>
            </li>
        </ul>
    </div>
    <main class="main">
        <div class="main_main clearfix">
            <nav class="left_nav">
                <div class="left_personal_center left_nav_li">
                    <span class="left_nav_title">个人中心</span>
                    <ul>
                        <li><a href="../personal_center_page/main_info_student?<?php echo $url_user_id ?>"><span>个人信息</span></a></li>
                        <li><a href="../personal_center_page/main_change_info_student?<?php echo $url_user_id ?>"><span>修改信息</span></a></li>
                    </ul>
                </div>
                <div class="left_select_information left_nav_li">
                    <span class="left_nav_title">查询信息</span>
                    <ul>
                        <li><a href="../select_page/select_student_student.php?<?php echo $url_user_id ?>"><span>查询学生</span></a></li>
                        <li><a href="../select_page/select_teacher_student.php?<?php echo $url_user_id ?>"><span>查询老师</span></a></li>
                        <li><a href="../select_page/select_team_student.php?<?php echo $url_user_id ?>"><span>查询团队</span></a></li>
                        <li><a href="../select_page/select_activity_student.php?<?php echo $url_user_id ?>"><span>查询活动</span></a></li>
                        <li><a href="../select_page/select_achievement_student.php?<?php echo $url_user_id ?>"><span>查询成果</span></a></li>
                        <li><a href="../select_page/select_student_team_student.php?<?php echo $url_user_id ?>"><span>查询组队</span></a></li>
                    </ul>
                </div>
            </nav>
            <div class="main_info">
                <div class="main_info_title">
                    <div class="main_info_title_span">
                        <span>查询信息</span>
                    </div>
                </div>
                <div class="main_info_top_nav">
                    <ul class="clearfix">
                        <li><a href="../select_page/select_student_student.php?<?php echo $url_user_id ?>"><span>查询学生</span></a></li>
                        <li><a href="../select_page/select_teacher_student.php?<?php echo $url_user_id ?>"><span>查询老师</span></a></li>
                        <li><a href="../select_page/select_team_student.php?<?php echo $url_user_id ?>"><span>查询团队</span></a></li>
                        <li><a href="../select_page/select_activity_student.php?<?php echo $url_user_id ?>"><span>查询活动</span></a></li>
                        <li><a href="../select_page/select_achievement_student.php?<?php echo $url_user_id ?>"><span>查询成果</span></a></li>
                        <li class="hightlight"><a href="../select_page/select_student_team_student.php?<?php echo $url_user_id ?>"><span>查询组队</span></a></li>
                    </ul>
                </div>
                <div class="main_body clearfix">
                    <form action="<?php echo $_SERVER['PHP_SELF'] . '?' . urldecode($_SERVER['QUERY_STRING']); ?>" method="post">
                        <input type="text" name="id" id="id" placeholder="请输入需要查询的学号">
                        <input type="text" name="team_id" id="team_id" placeholder="请输入需要查询的团队号">
                        <input type="submit" name="submit" id="submit" value="提交">
                        <input type="reset" name="reset" id="reset">
                    </form>

                    <div class="main_body_info">
                        <?php
                        $id = get_id();
                        $team_id = get_team_id();
                        if ($id != '' || $team_id != '') {
                            $where_section = ($id == '' ? '' : (' AND student_id="' . $id . '"')) . ($team_id == '' ? '' : (' AND team_id="' . $team_id . '"'));
                            $where_section = 'WHERE ' . substr($where_section, 5);
                            $query = 'SELECT `student_id`, `team_id` FROM ' . STUDENT_TEAM_TABLE . ' ' . $where_section;
                            $result = mysqli_query($link, $query);
                            $array = @mysqli_fetch_all($result);
                            $array_count = @count($array);
                            if ($array_count == 0) {
                                echo '
                                    <script>
                                        alert("没有查询到数据");
                                    </script>
                                ';
                            } else {
                                echo '
                                <table>
                                    <thead>
                                        <tr>
                                            <td>学号</td>
                                            <td>学生姓名</td>
                                            <td>团队编号</td>
                                            <td>团队名</td>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                for ($i = 0; $i < $array_count; ++$i) {
                                    $id = $array[$i][0];
                                    $query = "SELECT `name` FROM `student` WHERE id=\"$id\"";
                                    $student_name = mysqli_query($link, $query);
                                    $student_name = mysqli_fetch_all($student_name);
                                    $student_name = $student_name[0][0];
                                    $id = $array[$i][1];
                                    $query = "SELECT `name` FROM `team` WHERE id=\"$id\"";
                                    $team_name = mysqli_query($link, $query);
                                    $team_name = mysqli_fetch_all($team_name);
                                    $team_name = $team_name[0][0];
                                    echo "
                                <tr>
                                    <td>{$array[$i][0]}</td>
                                    <td>{$student_name}</td>
                                    <td>{$array[$i][1]}</td>
                                    <td>{$team_name}</td>
                                </tr>";
                                }
                                echo '
                                    </tbody>
                                </table>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>