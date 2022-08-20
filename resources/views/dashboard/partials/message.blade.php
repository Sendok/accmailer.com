@if (session("guest.next"))
	<ul class="content-list text-left">
        <!-- Single Content List -->
        <li class="single-content-list media py-2">
            <div class="content-icon pr-4">
                <span class="color-1"><i class="fas fa-angle-double-right"></i></span>
            </div>
            <div class="text-white content-text media-body">
                <span><b>Status : {{ session("guest.next")["status"] }}</b></span>
            </div>
        </li>
        <!-- Single Content List -->
        <li class="single-content-list media py-2">
            <div class="content-icon pr-4">
                <span class="color-1"><i class="fas fa-angle-double-right"></i></span>
            </div>
            <div class="text-white content-text media-body">
                <span><b>Email  &nbsp&nbsp: {{ session("guest.next")["email"] }}</b></span>
            </div>
        </li>
        <!-- Single Content List -->
        <li class="single-content-list media py-2">
            <div class="content-icon pr-4">
                <span class="color-1"><i class="fas fa-angle-double-right"></i></span>
            </div>
            <div class="text-white content-text media-body">
                <span><b>SMTP  &nbsp&nbsp: {{ session("guest.next")["smtp"] }}</b></span>
            </div>
        </li>
        <!-- Single Content List -->
        <li class="single-content-list media py-2">
            <div class="content-icon pr-4">
                <span class="color-1"><i class="fas fa-angle-double-right"></i></span>
            </div>
            <div class="text-white content-text media-body">
                <span><b>IP &nbsp &nbsp &nbsp &nbsp : {{ session("guest.next")["target"] }}</b></span>
            </div>
        </li>
    </ul>
	@elseif (session("guest.max"))
	<ul class="content-list text-left">
        <!-- Single Content List -->
        <li class="single-content-list media py-2">
            <div class="content-icon pr-4">
                <span class="color-1"><i class="fas fa-angle-double-right"></i></span>
            </div>
            <div class="text-white content-text media-body">
                <span><b>Your Free Verification Reached Limit :)</b></span>
            </div>
        </li>
    </ul>
@endif
@if (session("validate.result"))
<div class="col-lg-6 col-xl-7">
    <div class="card">
        <div class="card-body">

        <div class="d-flex align-items-center">
            <h2 class="card-title mnb-6 mr-auto">Result</h2><button class="btn btn-brand btn-uniform btn-round btn-sm mnt-8 mnb-8" type="button"><span  data-feather="download" class="rui-icon rui-icon-stroke-1_5"></span></button>
        </div>
        <ul class="list-group list-group-flush rui-profile-task-list">
            <li class="list-group-item">
            <div class="rui-task rui-task-danger">
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" href="task.html">STATUS</a><small class="rui-task-subtitle">INVALID</small></div>
            </div>
            </li>
            <li class="list-group-item">
            <div class="rui-task rui-task-success">
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" href="task.html">SMTP HOST</a><small class="rui-task-subtitle">SMTP.GMAIL.COM</small></div>
            </div>
            </li>
            <li class="list-group-item">
            <div class="rui-task rui-task-success">
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" href="task.html">DOMAIN</a><small class="rui-task-subtitle">GMAIL.COM</small></div>
            </div>
            </li>
            <li class="list-group-item">
            <div class="rui-task rui-task-success">
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" href="task.html">MX RECORD</a><small class="rui-task-subtitle">VALID</small></div>
            </div>
            </li>
            <li class="list-group-item">
            <div class="rui-task rui-task-success">
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" href="task.html">IP TARGET</a><small class="rui-task-subtitle">17.123.424.12</small></div>
            </div>
            </li>

        </ul>
        </div>
    </div>
</div>
@endif