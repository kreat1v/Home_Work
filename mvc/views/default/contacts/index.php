<?php
// Представление контроллера Contacts - форма обратной связи.
?>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-8 col-12">
        <h1>Leave your message</h1>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-8 col-12">
        <form method="post">
            <div class="form-group">
                <label for="exampleInputName1">How can we apply to you?</label>
                <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Your name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputMessages1">Messages</label>
                <textarea rows="5" name="messages" id="exampleInputMessages1" class="form-control" placeholder="Your message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>