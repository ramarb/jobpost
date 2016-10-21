<form action="<?php echo base_url('vacancies/apply/' . $vacancies_id)?>" method="post">
    <p>
        <input type="hidden" name="vacancies_id" value="<?php echo $vacancies_id?>">
        <button type="submit" class="btn btn-primary btn-lg">&nbsp;&nbsp;&nbsp;Apply&nbsp;&nbsp;&nbsp;</button>
    </p>
</form>