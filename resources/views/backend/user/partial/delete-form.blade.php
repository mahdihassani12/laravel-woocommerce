  <form method="get" action="{{asset('user/remove')}}" enctype="multipart/form-data" class="delete_form"> 
          <div class="modal-header">
            
            <h4 class="modal-title">{{trans('labels.delete_student')}}</h4>
            <button 
                type="button" 
                class="close" 
                data-dismiss="modal"
                style="border:none;">&times;</button>
           
          </div>
          <div class="popup_model_main_container">
            <div class="modal-body">
                <div class="form_area_par1">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left column">
                            <div class="input-form-group">
                                <p class="alert alert-info">{{trans('msg.are_sure_to_delete')}}</p>
                                 <input type="hidden" name="user_id" value="{{$data['user_id']}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button 
                        type="submit" 
                        class="btn btn-default btn-agree">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            <b>{{trans('labels.yes')}}</b>
                    </button>

                    <button 
                        type="button" 
                        data-dismiss="modal"
                        class="btn btn-default btn-cancel" style="margin-right:0">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            <b>{{trans('labels.cancel')}}</b>
                    </button>
                    
            </div>
        </div>
    </form>
    <script type="text/javascript">

 
         $(".delete_form").validate({
            ignore: [],
            rules: {
                enrol_id: {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
              },
          messages:{
              enrol_id:{
                        required: '{{trans("msg.field_required")}}',
              },
          },
          submitHandler: function (form) {
                    var ajx_loader = $(".custom_modal  .ajxload");
                    var modal_content = $(".custom_modal .modal-content");
                    ajx_loader.show();
                    modal_content.hide();
                        $.ajax({
                                method:'get',
                                url:''+APP_URL+'/user/remove',
                                data: $('.delete_form').serialize(),
                                success:function(response){
                                        ajx_loader.hide();
                                        modal_content.show();
                                        $('.popup_model_main_container').html(response);
                                        setTimeout(function() {location.reload()}, 1000);
                            }
                        });
                return false;
            } 
      });
    </script>