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
                    <i class="fa fa-history"></i> 号码走势图
                    <a style="float: right" href="ssq/line">更多»</a>
                </h2>
            </div>
            <div class="panel-body">
                <div id="line" style="height:550px;"></div>
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
                <img width="100%" alt="" src="img/qrcode.png" />
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">彩民留言板</h2>
            </div>
            <div class="panel-body">
                <div class="input-group">
                    <textarea class="form-control message" id="message" name="message" placeholder="请文明发言..."></textarea>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-index btn-success">发布</button>
                    </span>
                </div>
                <span class="countTxt">还能输入</span><strong class="maxNum">140</strong><span>个字</span>
                <hr>
                <div class="message">
                    <ul class="media-list">
                        <li class="media">
                            <div class="media-body">
                                <div class="media-content">
                                    <a href="javascript:void(0)">站长</a>: 欢迎大家交流选号技术
                                </div>
                                <div class="media-action">
                                    <span class="time">8分钟前</span> <span class="pull-right">
                                        <a href="javascript:void(0)">
                                            <i class="glyphicon glyphicon-thumbs-up"></i>
                                            666
                                        </a>
                                        <a href="javascript:void(0)">
                                            <i class="glyphicon glyphicon-thumbs-down"></i>
                                            666
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <hr>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='js/echarts.min.js'></script>
<script>
    var xAxis = '<?= $dateNumber ?>'.split("|");
    var red1List = '<?= $red1 ?>'.split("|");
    var red2List = '<?= $red2 ?>'.split("|");
    var red3List = '<?= $red3 ?>'.split("|");
    var red4List = '<?= $red4 ?>'.split("|");
    var red5List = '<?= $red5 ?>'.split("|");
    var red6List = '<?= $red6 ?>'.split("|");
    var blueList = '<?= $blue ?>'.split("|");
    var myChart = echarts.init(document.getElementById('line'));
    var option = {
        tooltip : {
            trigger : 'axis'
        },
        legend : {
            data : [ '红球一号走势', '红球二号走势', '红球三号走势', '红球四号走势', '红球五号走势', '红球六号走势', '蓝球号码走势' ],
            selected: {
                '红球二号走势': false,
                '红球三号走势': false,
                '红球四号走势': false,
                '红球五号走势': false,
                '红球六号走势': false,
                '蓝球号码走势': false
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : xAxis
            }
        ],
        yAxis : [
            {
                type : 'value',
                splitNumber : 32,
                min : 01,
                max : 33,
            }
        ],
        dataZoom : [
            {
                type : 'inside',
                start : 99,
                end : 100
            },
            {
                show : true,
                type : 'slider',
                y : '90%',
                start : 99,
                end : 100
            }
        ],
        grid : {
            left : '10%',
            right : '10%',
            bottom : '15%'
        },
        series : [
            {
                name : '红球一号走势',
                type : 'line',
                data : red1List
            },
            {
                name : '红球二号走势',
                type : 'line',
                data : red2List
            },
            {
                name : '红球三号走势',
                type : 'line',
                data : red3List
            },
            {
                name : '红球四号走势',
                type : 'line',
                data : red4List
            },
            {
                name : '红球五号走势',
                type : 'line',
                data : red5List
            },
            {
                name : '红球六号走势',
                type : 'line',
                data : red6List
            },
            {
                name : '蓝球号码走势',
                type : 'line',
                data : blueList
            }
        ]
    };
    myChart.setOption(option);
</script>
<script src='js/echarts.min.js'></script>
<script>
    var red_data = [];
    for (var i = 0; i <= 32; i++) {
        red_data[i] = i + 1;
    }
    var red_data = formatData(red_data);

    var blue_data = [];
    for (var i = 0; i <= 15; i++) {
        blue_data[i] = i + 1;
    }
    var blue_data = formatData(blue_data);

    var myChart_pie_red = echarts.init(document.getElementById("red-pie"));
    var myChart_pie_blue = echarts.init(document.getElementById("blue-pie"));
    option_red = getOption("红球完全统计", red_data);
    option_blue = getOption("蓝球完整统计", blue_data);
    myChart_pie_red.setOption(option_red);
    myChart_pie_blue.setOption(option_blue);

    function formatData(data) {
        return data.map(function (item, i) {
            i+=1;
            if (i < 10) {
                i = "0" + i;
            }
            return {
                value: item,
                name: i + "出现次数"
            };
        });
    }

    function getOption(title, data) {
        return {
            title : {
                text: title,
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            series : [
                {
                    name: title,
                    type: 'pie',
                    radius : '50%',
                    data: data,
                }
            ]
        };
    }
</script>
