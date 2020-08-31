<div class="form-content">
    <?php if ($error == 1) : ?>
        <div style="background-color: rgba(255, 0, 0, 0.5); padding: 20px">
            ПАРОЛИ НЕ СОВПАДАЮТ
        </div>
    <?php endif; ?>
    <?php if ($error == 2) : ?>
        <div style="background-color: rgba(255, 0, 0, 0.5); padding: 20px">
            ПАРОЛЬ ДОЛЖЕН СОДЕРЖАТЬ НЕ МЕНЕЕ 4-Х СИМВОЛОВ
        </div>
    <?php endif; ?>
    <?php if ($error == 3) : ?>
        <div style="background-color: rgba(255, 0, 0, 0.5); padding: 20px">
            ВВЕДИТЕ ПОЖАЛУЙСТА ВСЕ ПОЛЯ
        </div>
    <?php endif; ?>
    <?php if ($error == 4) : ?>
        <div style="background-color: rgba(255, 0, 0, 0.5); padding: 20px">
            ПОЛЬЗОВАТЕЛЬ С ТАКИМ E-MAIL УЖЕ СУЩЕСТВУЕТ
        </div>
    <?php endif; ?>
    <h2>Форма регистрации</h2>
    <form action="/mvc/public/reg" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="user_name" placeholder="Your Name *" value=""/>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Your email *" value=""/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="password1" placeholder="Your Password *" value=""/>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="password2" placeholder="Confirm Password *" value=""/>
            </div>
        </div>
    </div>
    <button type="submit">Submit</button>
    </form>
</div>