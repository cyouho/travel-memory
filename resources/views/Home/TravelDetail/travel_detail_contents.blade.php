<div>
    <div class="home-top"></div>
    <div class="container-xl px-3 px-md-4 px-lg-5">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="display-1 text-center">{{$data['userName']}}</h1>
            </div>
            <div class="col-sm-8">
                <h2 class="text-center word">旅行详细</h2>
                <br>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">最新旅行记录</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                        <form>
                            <div class="form-group">
                                <label for="sel1">选择年份:</label>
                                <select class="form-control" id="detail-years">

                                </select>
                            </div>
                        </form>
                        <div id="main" style="height: 400px;"></div>
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                        <h3>Menu 1</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="menu2" class="container tab-pane fade"><br>
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>