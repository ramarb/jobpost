/**
 * Created by ramon on 10/26/16.
 */
$(window).load(function(){
    delete_warning(".delete");
});

function delete_warning(locator){
    $(locator).on('click',function(){

        if(confirm('Are you sure you want to delete this record?') === false){
            return false;
        }

    });
}