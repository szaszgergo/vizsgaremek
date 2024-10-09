<style>
    #jelszomodositas{
        text-decoration: underline;
    }
</style>
<div class="row fiokrow">
    <div class="col-md-8 ">
        <form class="form bg-dark text-light fiok" action="actions/updatepassword.php" method=post target='kisablak'>
            <div id='error-message' class='alert alert-danger' style='display: none;'></div>
            <div class="mb-3">
                <label for="InputOldPassword" class="form-label">Régi jelszó</label>
                <input type="password" class="form-control form-control-dark" id="InputOldPassword" name="oldpw" maxlength="100" >
            </div>
            <div class="mb-3">
                <label for="InputNewPassword" class="form-label">Új jelszó</label>
                <input  type="password" class="form-control form-control-dark" id="InputNewPassword" name="newpw" maxlength="256" >
            </div>
       
         
            

            <button type="submit" class="btn btn-warning w-100">Adatok mentése</button>
        </form>
    </div>
   
</div>