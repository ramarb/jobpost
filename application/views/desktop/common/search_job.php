					<form class="navbar-form navbar-left" id="public-search-vacancy" role="search" method="post" action="<?php echo base_url('vacancies/search') ?>">
                        <div class="form-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Search" value="<?php echo $this->session->userdata('public_vacancy_keyword')?>">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="submit" class="btn btn-default" id="clear-public-search">Clear Search</button>
                    </form>
                    <script type="text/javascript">
                    	$(window).load(function(){
                    		$("#public-search-vacancy").on('submit',function(){
                    			if($('#public-search-vacancy div input[name="keyword"]').val().length < 4 && $('#public-search-vacancy div input[name="keyword"]').val().length > 0){
                    				alert('Please type at least 4 characters!');
                    				return false;	
                    			}
                    		});
                    		$("#clear-public-search").on('click',function(){
                    			$('#public-search-vacancy div input[name="keyword"]').val('');
                    		});
                    	});
                    </script>