@if(Session::has('alert_class'))
<div class="modal-body">
    <div class="form_area_par1"  style="padding-bottom: 15px;">
        <div class="row">
            <div class="col-lg-12">
                <div 
                    class="alert {{ Session::get('alert_class') }}" 
                    style="margin-bottom:0;width:100%;float:left;">
                    <button 
                        type="button" 
                        class="close" 
                        data-dismiss="alert" 
                        aria-label="Close"
                        style="padding-left:10px;">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ Session::get('alert_message')}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button 
        type="button"
        data-dismiss="modal" 
        class="btn btn-default btn-cancel pull-left">
            {{trans("labels.cancel")}}
    </button>
</div>
@endif

