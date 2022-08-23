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
@if (session("validate.next"))
<div class="col-lg-6 col-xl-7">
    <div class="card">
        <div class="card-body">

        <div class="d-flex align-items-center">
            <h2 class="card-title mnb-6 mr-auto">Result</h2><a href="{{ route('singleExport.get', ['slug' => session('validate.next')['id']]) }}" class="btn btn-brand btn-uniform btn-round btn-sm mnt-8 mnb-8" target="_blank"><span  data-feather="download" class="rui-icon rui-icon-stroke-1_5"></span></a>
        </div>
        <ul class="list-group list-group-flush rui-profile-task-list">
            <li class="list-group-item">
            @if(session("validate.next")["status"] == 'valid')
            <div class="rui-task rui-task-success">
            @else
            <div class="rui-task rui-task-danger">
            @endif
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" >STATUS</a><small class="rui-task-subtitle" style="text-transform:uppercase;">{{ session("validate.next")["status"] }}</small></div>
            </div>
            </li>
            <li class="list-group-item">
            @if(session("validate.next")["status"] == 'valid')
            <div class="rui-task rui-task-success">
            @else
            <div class="rui-task rui-task-danger">
            @endif
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" >EMAIL</a><small class="rui-task-subtitle" style="text-transform:uppercase;">{{ session("validate.next")["email"] }}</small></div>
            </div>
            </li>
            <li class="list-group-item">
            @if(session("validate.next")["status"] == 'valid')
            <div class="rui-task rui-task-success">
            @else
            <div class="rui-task rui-task-danger">
            @endif
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" >SMTP HOST</a><small class="rui-task-subtitle" style="text-transform:uppercase;">{{ session("validate.next")["smtp"] }}</small></div>
            </div>
            </li>
            <li class="list-group-item">
            @if(session("validate.next")["status"] == 'valid')
            <div class="rui-task rui-task-success">
            @else
            <div class="rui-task rui-task-danger">
            @endif
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" >DOMAIN</a><small class="rui-task-subtitle" style="text-transform:uppercase;">{{ session("validate.next")["host"] }}</small></div>
            </div>
            </li>
            <li class="list-group-item">
            @if(session("validate.next")["status"] == 'valid')
            <div class="rui-task rui-task-success">
            @else
            <div class="rui-task rui-task-danger">
            @endif
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" >MX RECORD</a><small class="rui-task-subtitle" style="text-transform:uppercase;">{{ session("validate.next")["type"] }}</small></div>
            </div>
            </li>
            <li class="list-group-item">
            @if(session("validate.next")["status"] == 'valid')
            <div class="rui-task rui-task-success">
            @else
            <div class="rui-task rui-task-danger">
            @endif
                <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                <div class="rui-task-content"><a class="rui-task-title" >IP TARGET</a><small class="rui-task-subtitle" style="text-transform:uppercase;">{{ session("validate.next")["target"] }}</small></div>
            </div>
            </li>

        </ul>
        </div>
    </div>
</div>
@endif

@if (session("validate.max"))
<div class="col-lg-6 col-xl-7">
    <div class="card">
        <div class="card-body">
            <div class="alert alert-danger" role="alert">
                You have reached the verification limit
            </div>
        </div>
    </div>
</div>
@endif