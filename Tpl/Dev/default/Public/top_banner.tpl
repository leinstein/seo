      <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">德融嘉信开发平台</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <if condition="ACTION_NAME == 'index'">class="active"</if>><a href="__URL__">首页</a></li>
              <li <if condition="ACTION_NAME == 'getStarted'">class="active"</if>><a href="__URL__/getStarted">起步</a></li>
              <li <if condition="ACTION_NAME == 'frontEnd'">class="active"</if>><a href="__URL__/frontEnd">前端</a></li>
              <li <if condition="ACTION_NAME == 'backEnd'">class="active"</if>><a href="__URL__/backEnd">后端</a></li>
              <li <if condition="ACTION_NAME == 'tools'">class="active"</if>><a href="__URL__/tools">工具</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>