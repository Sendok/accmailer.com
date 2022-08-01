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