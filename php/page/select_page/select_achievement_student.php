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
                        <li class="hightlight"><a href="../select_page/select_achievement_student.php?<?php echo $url_user_id ?>"><span>查询成果</span></a></li>
                        <li><a href="../select_page/select_student_team_student.php?<?php echo $url_user_id ?>"><span>查询组队</span></a></li>
                    </ul>
                </div>
                <div class="main_body clearfix">
                    <form action="<?php echo $_SERVER['PHP_SELF'] . '?' . urldecode($_SERVER['QUERY_STRING']); ?>" method="post">
                        <input type="text" name="team_id" id="team_id" placeholder="请输入需要查询的团队号">
                        <input type="text" name="activity_id" id="activity_id" placeholder="请输入需要查询的课外活动编号">
                        <input type="text" name="time_start" id="time_start" placeholder="不早于何时">
                        <input type="text" name="time_end" id="time_end" placeholder="不晚于何时">
                        <input type="text" name="teacher_id" id="teacher_id" placeholder="请输入需要查询的指导老师编号">
                        <input type="text" name="academy" id="academy" placeholder="请输入需要查询的报送学院">
                        <input type="submit" name="submit" id="submit" value="提交">
                        <input type="reset" name="reset" id="reset">
                    </form>

                    <div class="main_body_info">
                        <?php
                        $team_id = get_team_id();
                        $activity_id = get_activity_id();
                        $time_start = get_time_start();
                        $time_end = get_time_end();
                        $teacher_id = get_teacher_id();
                        $academy = get_academy();
                        if ($team_id != '' || $activity_id != '' || $time_start != '' || $time_end != '' || $teacher_id != '' || $academy != '') {
                            $where_section = ($team_id == '' ? '' : (' AND team_id="' . $team_id . '"')) . ($activity_id == '' ? '' : (' AND activity_id="' . $activity_id . '"')) . ($time_start == '' ? '' : (' AND time>="' . $time_start . '"')) . ($time_end == '' ? '' : ' AND time<="' . $time_end . '"') . ($teacher_id == '' ? '' : (' AND teacher_id="' . $teacher_id . '"')) . ($academy == '' ? '' : (' AND academy="' . $academy . '"'));
                            $where_section = 'WHERE ' . substr($where_section, 5);
                            $query = 'SELECT * FROM ' . ACHIEVEMENT_TABLE . ' ' . $where_section;
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
                                            <td>团队名</td>
                                            <td>课外活动名</td>
                                            <td>完成时间</td>
                                            <td>指导老师</td>
                                            <td>报送学院</td>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                for ($i = 0; $i < $array_count; ++$i) {
                                    $id = $array[$i][0];
                                    $query = "SELECT `name` FROM `team` WHERE id=\"$id\"";
                                    $result = mysqli_query($link, $query);
                                    $result = mysqli_fetch_all($result);
                                    $team_name = $result[0][0];
                                    $id = $array[$i][1];
                                    $query = "SELECT `name` FROM `activity` WHERE id=\"$id\"";
                                    $result = mysqli_query($link, $query);
                                    $result = mysqli_fetch_all($result);
                                    $activity_name = $result[0][0];
                                    echo "
                                <tr>
                                    <td>{$team_name}</td>
                                    <td>{$activity_name}</td>
                                    <td>{$array[$i][2]}</td>
                                    <td>{$array[$i][3]}</td>
                                    <td>{$array[$i][4]}</td>
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