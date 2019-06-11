<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form id="productFrm" method='post'>
                
                    <label for="">name</label>
                    <input type="text" name="name" id="name">
                <br>
                    <label for="">model</label>
                    <input type="text" name="model" id="model">
                <br>
                    <label for="">color</label>
                    <input type="text" name="color" id="color">
                <br>
                <input type="submit" id="submit" name="submit" value="Submit">
            </form>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Color</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>



<script type="text/javascript">
    $('document').ready(function(){
        $('#submit').click(function(){
            // console.log($('#productFrm').serialize());
            $data = {
                name: $('name').val(),
                model: $('model').val(),
                color: $('color').val()
            }
            
            $.post('<?php echo base_url()."product/save"?>',$('#productFrm').serialize(),function(data){
                console.log('returned data');
                console.log(data);
            });
        })
    })
</script>