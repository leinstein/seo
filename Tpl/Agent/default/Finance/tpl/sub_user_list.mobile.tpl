	<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<div class="weui-media-box weui-media-box_appmsg">
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">{$vo['username']}<a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_warn fr open-popup" data-id="{$vo['id']}" data-username="{$vo['username']}" data-epname="{$vo['epname']}" data-product="{$vo['product_str']}" data-target="#full">充值</a></h4>
			<p class="weui-media-box__desc mt5"><span>{$vo['epname']}</span></p>
			<p class="weui-media-box__desc mt5">
				<span>开通产品：{$vo['product_desc']}</span>
			</p>
			<p class="weui-media-box__desc mt5">
				<span>总资金：{$vo['totalfunds']|format_money}</span>
				<span class="ml10">资金余额：{$vo['balancefunds']|format_money}</span>
				<span class="ml10">可用余额：{$vo['availablefunds']|format_money}</span>
			</p>
		</div>
	</div>
	</volist>
	<else/>
		<div class="weui-media-box weui-media-box_appmsg">
	
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title pl10 pt10 pb 10">暂无相关数据</h4>
			
		</div>
	</div>
	</notempty>
	<script>

	$(document).on("click", ".btn_recharge", function() {
		//alert( $(this).attr( "data_id" ) );
		var is_recharge_limit = "{$is_recharge_limit}";
		var text = "";
		if( is_recharge_limit == 1 ){
			text = "充值金额最少为5000元";
		}
    	$.prompt({
      		text: text,
      		title: "输入金额",
      		onOK: function(value) {
      			
      			value = $.trim( value);
      			// 是否输入了金额
				if( !value ){
					$.toptip('请输入金额', 'error');
					return false;
				}
				
				// 金额输入的示是否正确
				if( !verifyMoney(value)){
					//return "您输入的金额格式不正确！";
					$.toptip('您输入的金额格式不正确', 'error');
					return false;
				}

				// 金额是否大于可用余额
				if( accSub(value , 5000 ) < 0 && is_recharge_limit == 1 ){
					$.toptip('充值金额最少为5000元', 'error');
					return false;
					
				}

				/* // 金额是否大于可用余额
				if( accSub(value , availablefunds ) > 0 ){
					return "您输入的金额不能大于资金池余额！";
				} */
      			
      			
        		$.alert("您的名字是:"+value, "角色设定成功");
      		},
      		onCancel: function() {
        		//console.log("取消了");
      		},
      		input: ''
    	});
  });
</script>