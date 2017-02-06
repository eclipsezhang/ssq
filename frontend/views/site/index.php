<?php

$this->title = "双色球论坛";

?>
<div class="row">
    <div class="col-md-9">
        <div class="jumbotron">
            <h1>
                <font class="fast">最新开奖号码</font>
            </h1>
            <p>开奖日期：<?= $model->date ?>(期号：<?= $model->datenumber ?>)</p>
            <p>
                <div class="circle-red"><?= $model->red1 ?></div>
                <div class="circle-red"><?= $model->red2 ?></div>
                <div class="circle-red"><?= $model->red3 ?></div>
                <div class="circle-red"><?= $model->red4 ?></div>
                <div class="circle-red"><?= $model->red5 ?></div>
                <div class="circle-red"><?= $model->red6 ?></div>
                <div class="circle-blue"><?= $model->blue ?></div>
            </p>
            <p>本期一等奖：<?= $model->goldnum ?>注，每注<?= $model->goldamount ?>元</p>
            <p>本期二等奖：<?= $model->goldnum2 ?>注，每注<?= $model->goldamount2 ?>元</p>
            <p>奖池总金额：<?= $model->sumamount ?>元</p>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    我要选号
                    <a style="float: right" href="index.php?r=site/line">详情»</a>
                </h2>
            </div>
            <div class="panel-body">
                <div class="keyboard-wrapper">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="btn-group btn-group-justified online-num">
            <a class="btn btn-index btn-primary" href="javascript:void(0)">
                <?php
                    $weekend = date('w');
                    if ($weekend == 2 || $weekend == 4 || $weekend == 0) {
                        echo "今日晚九点十五开奖，敬请期待！";
                    } else {
                        echo "今日不开奖";
                    }
                ?>
            </a>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">我来支持一个</h2>
            </div>
            <div class="panel-body">
                <img width="100%" alt="" src="/ssq/frontend/web/img/qrcode.png" />
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    彩民留言板
                    <a style="float: right" href="javascript:void(0)" onclick="refreshMessage()"><span class="glyphicon glyphicon-refresh">刷新</span></a>
                </h2>
            </div>
            <div class="panel-body">
                <div class="input-group">
                    <textarea class="form-control message" id="message" name="message" onkeypress="textareaKeyup()" onkeyup="textareaKeyup()" onkeydown="textareaKeyup()" maxlength="140" placeholder="请文明发言..."></textarea>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-index btn-success" onclick="push()">发布</button>
                    </span>
                </div>
                <span class="countTxt">还能输入</span><strong class="maxNum">140</strong><span>个字</span>
                <hr>
                <div class="message">
                    <ul class="media-list" id="message-ul">
                        <?php
                            foreach ($messages as $message) {
                                echo '
                                    <li>
                                        <div class="media-body">
                                            <div class="media-content">
                                                <a href="javascript:void(0)">' . $message->username . '</a>: ' . $message->message . '
                                            </div>
                                            <div class="media-action">
                                                <span class="time">' . $message->time . '</span> <span class="pull-right">
                                                    <a href="javascript:void(0)" onclick="up()">
                                                        <i class="glyphicon glyphicon-thumbs-up"></i>
                                                        ' . $message->up . '
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="down()">
                                                        <i class="glyphicon glyphicon-thumbs-down"></i>
                                                        ' . $message->down . '
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        <hr/>
                                    </li>
                                ';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function IsPC() {
        var userAgentInfo = navigator.userAgent;
        var Agents = ["Android", "iPhone",
                    "SymbianOS", "Windows Phone",
                    "iPad", "iPod"];
        for (var v = 0; v < Agents.length; v++) {
            if (userAgentInfo.indexOf(Agents[v]) > 0) {
                $("#line-pie").css("display", "none");
                break;
            }
        }
    });

    function textareaKeyup() {
        var textareaLen = eval($("#message").val().length);
        var textNum = 140 - textareaLen;
        if (textNum < 0) {
            $("strong.maxNum").html(0);
        } else {
            $("strong.maxNum").html(textNum);
        }
    }

    function push() {
        var message = $("#message").val();
        var url = '/ssq/frontend/web/index.php?r=site/message';
        $.ajax({
            type: 'post',
            data: {message:message},
            dataType: 'json',
            url: url,
            success: function(data) {
                if (data.flag) {
                    $("#message-ul").prepend('<li> <div class="media-body"> <div class="media-content"> <a href="javascript:void(0)">' + data.username + '</a>: ' + data.message + ' </div> <div class="media-action"> <span class="time">' + data.time + '</span> <span class="pull-right"> <a href="javascript:void(0)" onclick="up()"> <i class="glyphicon glyphicon-thumbs-up"></i>0</a> <a href="javascript:void(0)" onclick="down()"> <i class="glyphicon glyphicon-thumbs-down"></i>0</a> </span> </div> </div> <hr/> </li>');
                    $("#message").val("");
                }
            },
            error: function() {
                alert("error");
            }
        });
    }

    function up() {
        alert("暂不支持点赞功能");
    }

    function down() {
        alert("暂不支持此功能");
    }

    function refreshMessage() {

    }
</script>
