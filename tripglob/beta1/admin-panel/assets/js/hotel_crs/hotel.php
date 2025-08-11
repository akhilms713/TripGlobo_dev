<script>
        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>
    <script>
    $(document).ready(function(){
        $(document).on('click','.supplier_validate',function(){
            var password = $('.password').val();
            var confirm_password =$('.confirm_password').val();
            if(password == confirm_password){ return true; }
            else $('.confirm_password').focus(); return false;
        });
        $(document).on('click','.select_handeled',function(){
            var HandeledBy = $(this).val();
        });
        $(document).on('click','.select_managed',function(){
            var ManagedBy = $(this).val();
            if(ManagedBy == 'supplier'){
            $.ajax({
                url:"<?php echo WEB_URL; ?>hotel_crs/managed_by",
                type:"POST",
                data:{ManagedBy:ManagedBy},
            }).done(function(data){
                $('.select_handeled').html(data);
            });
        }
        else
        {
            $('.select_handeled').html('<option value="1">Admin</option>');
        }
        });
    });
    </script>
<script>
$(document).ready(function(){
    $('.city_list').hide();
    $(document).on('keyup','.city_select',function(){
        var Country = $('.country').val();
        var city = $(this).val();
         $('.city_list').show();
        $.ajax({
            url:"<?php print WEB_URL ?>hotel_crs/getCityList",
            type:"POST",
            data:{Country:Country,city:city},
        }).done(function(data){
            $('.city_list').html(data);
        });
        });
    $(document).on('click','body',function(){
         $('.city_list').hide();
    });
    $(document).on('click','.city_list p',function(){
        $('.city_select').val($(this).text());
    });
    });

</script>