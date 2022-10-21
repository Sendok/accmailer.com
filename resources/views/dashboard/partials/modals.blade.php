<!-- Modal -->
<div class="modal fade" id="bulkModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="bulkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bulk Verification #ACC<span id="id-text" >0</span></h5>
                <div id="bulk-download">
                  <a id='link-export' class="btn btn-brand btn-uniform btn-round btn-sm mnt-8 mnb-8" ><span  data-feather="download" class="rui-icon rui-icon-stroke-1_5"></span>DOWNLOAD REPORT</a>
                </div>
            </div>
            <div class="modal-body">
            <div id="loader-bulk" class="lenovo-loader">
              <div class="loader">
                <div style="width: 100%;">
                    <p class="small hint-text"><span id="loader-text" >-</span><span class="pull-right"><span id="loader-progress">0</span>%</span></p>
                  <div class="progress">
                    <div id="loader-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-brand" style="width:0%"></div>
                  </div>
                </div>
              </div>
            </div> 
            <div id="result-bulk">
            <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <ul class="list-group list-group-flush rui-profile-task-list">
                    <li class="list-group-item">
                    <div class="rui-task rui-task-success">
                        <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                        <div class="rui-task-content"><a class="rui-task-title" href="task.html">STATUS VALID</a><small class="rui-task-subtitle"><span id="valid-text" >0</span> EMAIL</small></div>
                    </div>
                    </li>
                    <li class="list-group-item">
                    <div class="rui-task rui-task-danger">
                        <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                        <div class="rui-task-content"><a class="rui-task-title" href="task.html">STATUS INVALID</a><small class="rui-task-subtitle"><span id="invalid-text" >0</span> EMAIL</small></div>
                    </div>
                    </li>
                    <li class="list-group-item">
                    <div class="rui-task rui-task-warning">
                        <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                        <div class="rui-task-content"><a class="rui-task-title" href="task.html">STATUS DISPOSABLE</a><small class="rui-task-subtitle"><span id="disposable-text" >0</span> EMAIL</small></div>
                    </div>
                    </li>
                    <li class="list-group-item">
                    <div class="rui-task rui-task-warning">
                        <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                        <div class="rui-task-content"><a class="rui-task-title" href="task.html">STATUS CHECK</a><small class="rui-task-subtitle"><span id="checkall-text" >0</span> EMAIL</small></div>
                    </div>
                    </li>

                </ul>
                </div>
            </div>
            </div>
            </div>
            </div>
            <div id="close" class="modal-footer">
                <button type="button" class="btn btn-brand" data-dismiss="modal" onClick="window.location.href=window.location.href">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bulkModalErrorBrowser" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="bulkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bulk Verification Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span data-feather="x" class="rui-icon rui-icon-stroke-1_5"></span>
                </button>
            </div>
            <div class="modal-body">
                <p>File not selected, Please select file to continue Bulk Verification.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-brand" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bulkModalReachLimit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="bulkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bulk Verification Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="window.location.href=window.location.href">
                    <span data-feather="x" class="rui-icon rui-icon-stroke-1_5"></span>
                </button>
            </div>
            <div class="modal-body">
                <p>You Reach limit for Verification please upgrade plan or continue plan on Menu Plan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-brand" data-dismiss="modal" onClick="window.location.href=window.location.href">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tokenCopy" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="bulkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="window.location.href=window.location.href">
                    <span data-feather="x" class="rui-icon rui-icon-stroke-1_5"></span>
                </button>
            </div>
            <div class="modal-body">
                <p>API key copied</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-brand" data-dismiss="modal" onClick="window.location.href=window.location.href">Close</button>
            </div>
        </div>
    </div>
</div>
