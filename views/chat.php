<div class="row">
  <span id="cnotify"></span>
    <div class="panel panel-default">
      <div class="panel-heading panelHNew">Bit Points - Live Chat</div>
      <div class="panel-body">
        <div id="chatBox" class="container">
          <!--CHATBOX Content -->
        </div>
        <div class="panel-footer">
             <form id="chatSend" class="input-group" action="/models/chat.php" method="POST">
              <input type="text" id="messageBody" name="messageBody" class="form-control" placeholder="Message"/>
              <span class="input-group-btn">
                <button class="btn btn-default" id="sendMessage" type="submit">Send</button>
              </span>
            </form>
        </div>
      </div>
    </div>
</div>
