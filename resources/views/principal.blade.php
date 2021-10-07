@extends('home')
@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Chart-1 -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Real Time Chart</h5>
            <div id="real-time" style="height: 400px; padding: 0px; position: relative;">
              <canvas class="flot-base" width="753" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 753px; height: 400px;"></canvas>
              <div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;">
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 25px; text-align: center;">0</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 93px; text-align: center;">10</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 165px; text-align: center;">20</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 237px; text-align: center;">30</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 309px; text-align: center;">40</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 382px; text-align: center;">50</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 454px; text-align: center;">60</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 526px; text-align: center;">70</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 598px; text-align: center;">80</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 670px; text-align: center;">90</div>
                </div>
                <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;">
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 368px; left: 9px; text-align: right;">70</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 306px; left: 9px; text-align: right;">75</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 245px; left: 9px; text-align: right;">80</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 184px; left: 9px; text-align: right;">85</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 123px; left: 9px; text-align: right;">90</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 62px; left: 9px; text-align: right;">95</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 2px; text-align: right;">100</div>
                </div>
              </div>
              <canvas class="flot-overlay" width="753" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 753px; height: 400px;"></canvas>
              </div>
            <p>
              Time between updates:
              <input id="updateInterval" type="text" value="" style="text-align: right; width: 5em">
              milliseconds
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- ENd chart-1 -->
    <!-- Chart-2 -->
    <!--<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Turning-series chart</h5>
            <div id="placeholder" style="height: 400px; padding: 0px; position: relative;"><canvas class="flot-base" width="1019" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1019px; height: 400px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 33px; text-align: center;">1988</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 140px; text-align: center;">1990</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 246px; text-align: center;">1992</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 353px; text-align: center;">1994</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 460px; text-align: center;">1996</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 566px; text-align: center;">1998</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 673px; text-align: center;">2000</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 780px; text-align: center;">2002</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 886px; text-align: center;">2004</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 993px; text-align: center;">2006</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 368px; left: 34px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 306px; left: 2px; text-align: right;">100000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 245px; left: 2px; text-align: right;">200000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 184px; left: 2px; text-align: right;">300000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 123px; left: 2px; text-align: right;">400000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 62px; left: 2px; text-align: right;">500000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 2px; text-align: right;">600000</div></div></div><canvas class="flot-overlay" width="1019" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1019px; height: 400px;"></canvas><div class="legend"><div style="position: absolute; width: 65.9531px; height: 133px; top: 14px; right: 18px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:14px;right:18px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(72,140,19);overflow:hidden"></div></div></td><td class="legendLabel">USA</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(27,85,192);overflow:hidden"></div></div></td><td class="legendLabel">Russia</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(218,75,15);overflow:hidden"></div></div></td><td class="legendLabel">UK</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(233,177,4);overflow:hidden"></div></div></td><td class="legendLabel">Germany</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(174,60,12);overflow:hidden"></div></div></td><td class="legendLabel">Denmark</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(57,112,15);overflow:hidden"></div></div></td><td class="legendLabel">Sweden</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(21,68,153);overflow:hidden"></div></div></td><td class="legendLabel">Norway</td></tr></tbody></table></div></div>
            <p id="choices" class="mt-3"><input type="checkbox" name="usa" checked="checked" id="idusa"><label for="idusa">USA</label><input type="checkbox" name="russia" checked="checked" id="idrussia"><label for="idrussia">Russia</label><input type="checkbox" name="uk" checked="checked" id="iduk"><label for="iduk">UK</label><input type="checkbox" name="germany" checked="checked" id="idgermany"><label for="idgermany">Germany</label><input type="checkbox" name="denmark" checked="checked" id="iddenmark"><label for="iddenmark">Denmark</label><input type="checkbox" name="sweden" checked="checked" id="idsweden"><label for="idsweden">Sweden</label><input type="checkbox" name="norway" checked="checked" id="idnorway"><label for="idnorway">Norway</label></p>
          </div>
        </div>
      </div>
    </div>-->
    <!-- End Chart-2 -->
    <!-- Cards -->
    <!--<div class="row">
      <div class="col-md-3">
        <div class="card mt-0">
          <div class="row">
            <div class="col-md-6">
              <div class="peity_line_neutral left text-center mt-2">
                <span><span style="display: none;"><span style="display: none;"><span style="display: none"><span style="display: none;">10,15,8,14,13,10,10</span><canvas width="50" height="24"></canvas></span>
                  <canvas width="50" height="24"></canvas>
                </span><canvas width="50" height="24"></canvas></span><canvas width="50" height="24"></canvas></span>
                <h6>10%</h6>
              </div>
            </div>
            <div class="col-md-6 border-left text-center pt-2">
              <h3 class="mb-0 fw-bold">150</h3>
              <span class="text-muted">New Users</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mt-0">
          <div class="row">
            <div class="col-md-6">
              <div class="peity_bar_bad left text-center mt-2">
                <span><span style="display: none;"><span style="display: none;"><span style="display: none"><span style="display: none;">3,5,6,16,8,10,6</span><canvas width="50" height="24"></canvas></span>
                  <canvas width="50" height="24"></canvas>
                </span><canvas width="50" height="24"></canvas></span><canvas width="50" height="24"></canvas></span>
                <h6>-40%</h6>
              </div>
            </div>
            <div class="col-md-6 border-left text-center pt-2">
              <h3 class="mb-0 fw-bold">4560</h3>
              <span class="text-muted">Orders</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mt-0">
          <div class="row">
            <div class="col-md-6">
              <div class="peity_line_good left text-center mt-2">
                <span><span style="display: none;"><span style="display: none;"><span style="display: none"><span style="display: none;">12,6,9,23,14,10,17</span><canvas width="50" height="24"></canvas></span>
                  <canvas width="50" height="24"></canvas>
                </span><canvas width="50" height="24"></canvas></span><canvas width="50" height="24"></canvas></span>
                <h6>+60%</h6>
              </div>
            </div>
            <div class="col-md-6 border-left text-center pt-2">
              <h3 class="mb-0">5672</h3>
              <span class="text-muted">Active Users</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mt-0">
          <div class="row">
            <div class="col-md-6">
              <div class="peity_bar_good left text-center mt-2">
                <span><span style="display: none;">12,6,9,23,14,10,13</span><canvas width="50" height="24"></canvas></span>
                <h6>+30%</h6>
              </div>
            </div>
            <div class="col-md-6 border-left text-center pt-2">
              <h3 class="mb-0 fw-bold">2560</h3>
              <span class="text-muted">Register</span>
            </div>
          </div>
        </div>
      </div>
    </div>-->
    <!-- End cards -->
    <!-- Chart-3 -->
    <!--<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Bar Chart</h5>
            <div class="flot-chart">
              <div class="flot-chart-content" id="flot-line-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" width="1019" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1019px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 23px; text-align: center;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 105px; text-align: center;">1</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 187px; text-align: center;">2</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 269px; text-align: center;">3</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 351px; text-align: center;">4</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 433px; text-align: center;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 515px; text-align: center;">6</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 597px; text-align: center;">7</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 679px; text-align: center;">8</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 762px; text-align: center;">9</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 840px; text-align: center;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 923px; text-align: center;">11</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 247px; left: 0px; text-align: right;">-1.0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 191px; left: 0px; text-align: right;">-0.5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 135px; left: 4px; text-align: right;">0.0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 79px; left: 4px; text-align: right;">0.5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 23px; left: 4px; text-align: right;">1.0</div></div></div><canvas class="flot-overlay" width="1019" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1019px; height: 300px;"></canvas><div class="legend"><div style="position: absolute; width: 49.75px; height: 38px; top: 14px; right: 13px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:14px;right:13px;;font-size:smaller;color:#AFAFAF"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(238,121,81);overflow:hidden"></div></div></td><td class="legendLabel">sin(x)</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(79,185,240);overflow:hidden"></div></div></td><td class="legendLabel">cos(x)</td></tr></tbody></table></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>-->
    <!-- End chart-3 -->
    <!-- Charts -->
    <!--<div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pie Chart</h5>
            <div class="pie" style="height: 400px; padding: 0px; position: relative;"><canvas class="flot-base" width="479" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 479.5px; height: 400px;"></canvas><canvas class="flot-overlay" width="479" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 479.5px; height: 400px;"></canvas><div class="legend"><div style="position: absolute; width: 57.5469px; height: 95px; top: 5px; right: 5px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:5px;right:5px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(72,140,19);overflow:hidden"></div></div></td><td class="legendLabel">Series1</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(27,85,192);overflow:hidden"></div></div></td><td class="legendLabel">Series2</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(218,75,15);overflow:hidden"></div></div></td><td class="legendLabel">Series3</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(233,177,4);overflow:hidden"></div></div></td><td class="legendLabel">Series4</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(174,60,12);overflow:hidden"></div></div></td><td class="legendLabel">Series5</td></tr></tbody></table></div><div class="pieLabelBackground" style="position: absolute; width: 40.1563px; height: 36px; top: 66px; left: 285.648px; background-color: rgb(0, 0, 0); opacity: 0.5;"> </div><span class="pieLabel" id="pieLabel0" style="position: absolute; top: 66px; left: 285.648px;"><div style="font-size:8pt;text-align:center;padding:2px;color:white;">Series1<br>22%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40.1563px; height: 36px; top: 299px; left: 284.648px; background-color: rgb(0, 0, 0); opacity: 0.5;"> </div><span class="pieLabel" id="pieLabel1" style="position: absolute; top: 299px; left: 284.648px;"><div style="font-size:8pt;text-align:center;padding:2px;color:white;">Series2<br>35%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40.1563px; height: 36px; top: 303px; left: 101.648px; background-color: rgb(0, 0, 0); opacity: 0.5;"> </div><span class="pieLabel" id="pieLabel2" style="position: absolute; top: 303px; left: 101.648px;"><div style="font-size:8pt;text-align:center;padding:2px;color:white;">Series3<br>7%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40.1563px; height: 36px; top: 232px; left: 49.6484px; background-color: rgb(0, 0, 0); opacity: 0.5;"> </div><span class="pieLabel" id="pieLabel3" style="position: absolute; top: 232px; left: 49.6484px;"><div style="font-size:8pt;text-align:center;padding:2px;color:white;">Series4<br>12%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40.1563px; height: 36px; top: 74px; left: 86.6484px; background-color: rgb(0, 0, 0); opacity: 0.5;"> </div><span class="pieLabel" id="pieLabel4" style="position: absolute; top: 74px; left: 86.6484px;"><div style="font-size:8pt;text-align:center;padding:2px;color:white;">Series5<br>24%</div></span></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Line Chart</h5>
            <div class="bars" style="height: 400px; padding: 0px; position: relative;"><canvas class="flot-base" width="479" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 479.5px; height: 400px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 17px; text-align: center;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 104px; text-align: center;">2</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 190px; text-align: center;">4</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 277px; text-align: center;">6</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 364px; text-align: center;">8</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 448px; text-align: center;">10</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 368px; left: 8px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 306px; left: 8px; text-align: right;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 245px; left: 2px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 184px; left: 2px; text-align: right;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 123px; left: 2px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 62px; left: 2px; text-align: right;">25</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 2px; text-align: right;">30</div></div></div><canvas class="flot-overlay" width="479" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 479.5px; height: 400px;"></canvas></div>
          </div>
        </div>
      </div>
    </div>--
</div>
@endsection