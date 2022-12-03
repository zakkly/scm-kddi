<?php
/* Smarty version 3.1.44, created on 2022-02-15 01:56:18
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/OrderDetail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_620a89b2f14ae0_80381480',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80340dfc43425e4d23cccdb462c8ba4ca4e5e568' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/OrderDetail.tpl',
      1 => 1644857775,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_620a89b2f14ae0_80381480 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="OrderDetails" data-code="<?php echo $_smarty_tpl->tpl_vars['r']->value["code"];?>
">
    <?php if ($_SESSION['role'] == "admin") {?>
    <header class="OrderSheet">
      <h1>発注指示書をダウンロード</h1>
    </header>
    <?php }?>
  <div class="box">
    <header>
      <h1>基本情報</h1>
    </header>
    <div class="body">
      <dl>
        <dt>発注No</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["code"];?>
</dd>
      </dl>
      <dl>
        <dt>発注日</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["regist"];?>
</dd>
      </dl>
      <dl>
        <dt>ステータス</dt>
        <dd><span class="status status<?php echo $_smarty_tpl->tpl_vars['r']->value["status_type"];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value["status"];?>
</span></dd>
      </dl>
      <dl>
        <dt>更新日</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["upd"];?>
</dd>
      </dl>
    </div>
  </div>
  <?php if ($_SESSION['role'] == "admin") {?>
  <div class="box statusChange">
    
    <header>
      <h1>ステータスを変更する</h1>
    </header>
    <div class="body">
      <ul>
        <?php $_smarty_tpl->_assignInScope('next', $_smarty_tpl->tpl_vars['r']->value["status_type"]+1);?>
        <li class="status status<?php echo $_smarty_tpl->tpl_vars['r']->value["status_type"];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value["status"];?>
</li>
        <li class="status status<?php echo $_smarty_tpl->tpl_vars['next']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['OrderTable']->value["status"]["item"][$_smarty_tpl->tpl_vars['next']->value];?>
</li>
        <li class="status status5"><?php echo $_smarty_tpl->tpl_vars['OrderTable']->value["status"]["item"][5];?>
</li>
      </ul>
    </div>
  </div>
  <?php } elseif ($_smarty_tpl->tpl_vars['r']->value["status_type"] == 0) {?>
  <div class="box statusChange">
    <div class="body">
      <ul>
        <li class="status status<?php echo $_smarty_tpl->tpl_vars['r']->value["status_type"];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value["status"];?>
</li>
        <li class="status status5"><?php echo $_smarty_tpl->tpl_vars['OrderTable']->value["status"]["item"][5];?>
する</li>
      </ul>
    </div>
  </div>
  <?php }?>
  <div class="box">
    <header>
      <h1>発注情報</h1>
    </header>
    <div class="body">
      <dl>
        <dt>注文ID</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["title"];?>
</dd>
      </dl>
      <dl>
        <dt>発注名</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["demo"];?>
</dd>
      </dl>
      <dl>
        <dt>ユーザ名</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["user"];?>
</dd>
      </dl>
      <dl>
        <dt>企業名</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["Company"];?>
</dd>
      </dl>
      <dl>
        <dt>配送先名</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["adressName"];?>
</dd>
      </dl>
      <dl>
        <dt>送付先住所</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["adress"];?>
</dd>
      </dl>
      <dl>
        <dt>送付先TEL</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["adressTel"];?>
</dd>
      </dl>
      <dl>
        <dt>送付先TEL</dt>
        <dd><?php echo $_smarty_tpl->tpl_vars['r']->value["adressTel"];?>
</dd>
      </dl>
    </div>  
  </div>
  <div class="box itemns">
    <header>
      <h1>受注詳細</h1>
    </header>
    <div class="body">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value["sets"], 'vs', false, 'ks');
$_smarty_tpl->tpl_vars['vs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ks']->value => $_smarty_tpl->tpl_vars['vs']->value) {
$_smarty_tpl->tpl_vars['vs']->do_else = false;
?>
      <div class="items sets">
        <div class="ttl">SET</div>
        <div class="img"><img src="<?php echo _IMG_;
if (!empty($_smarty_tpl->tpl_vars['vs']->value[0]["img"])) {
echo $_smarty_tpl->tpl_vars['vs']->value[0]["img"];
} else { ?>nowprinting.jpg<?php }?>"></div>
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["title"];?>
</div>
        <div class="num"><?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["number"];?>
セット</div>
      </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value["items"], 'vs', false, 'ks');
$_smarty_tpl->tpl_vars['vs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ks']->value => $_smarty_tpl->tpl_vars['vs']->value) {
$_smarty_tpl->tpl_vars['vs']->do_else = false;
?>
      <div class="items">
        <div class="ttl">単品商品</div>
        <div class="img"><img src="<?php echo _IMG_;
if (!empty($_smarty_tpl->tpl_vars['vs']->value[0]["img"])) {
echo $_smarty_tpl->tpl_vars['vs']->value[0]["img"];
} else { ?>nowprinting.jpg<?php }?>"></div>
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["name"];?>
</div>
        <div class="num"><?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["number"];
echo $_smarty_tpl->tpl_vars['unit']->value["unit"]["item"][$_smarty_tpl->tpl_vars['vs']->value[0]["unit"]];?>
</div>
      </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
  </div>
  <div class="box">
    <header>
      <h1>配送情報</h1>
    </header>
    <div class="body">
      <dl>
        <dt>希望配送日</dt>
        <dd>
          <?php if ($_SESSION['role'] == "admin") {?>
          <input type="text" name="OrderDate" id="OrderDate" value="<?php echo $_smarty_tpl->tpl_vars['r']->value["OrderDate"];?>
" class="date modalInner">
          <?php } else { ?>
          <?php echo $_smarty_tpl->tpl_vars['r']->value["OrderDate"];?>

          <?php }?>
        </dd>
      </dl>
      <dl>
        <dt>デモ実施日</dt>
        <dd>
          <?php if ($_SESSION['role'] == "admin") {?>
          <input type="text" name="OrderImplementation" id="OrderImplementation" value="<?php echo $_smarty_tpl->tpl_vars['r']->value["OrderImplementation"];?>
" class="date modalInner">
          <?php } else { ?>
          <?php echo $_smarty_tpl->tpl_vars['r']->value["OrderImplementation"];?>

          <?php }?>
        </dd>
      </dl>
      <dl>
        <dt>配送指定時間</dt>
        <dd>
          <?php if ($_SESSION['role'] == "admin") {?>
          <select name="OrderTime">
            <option>選択</option>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['OrderTime']->value, 'vs', false, 'ks');
$_smarty_tpl->tpl_vars['vs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ks']->value => $_smarty_tpl->tpl_vars['vs']->value) {
$_smarty_tpl->tpl_vars['vs']->do_else = false;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['ks']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['r']->value["OrderTime"] == $_smarty_tpl->tpl_vars['ks']->value) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['vs']->value;?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </select>
          <?php } else { ?>
          <?php echo $_smarty_tpl->tpl_vars['OrderTime']->value[$_smarty_tpl->tpl_vars['r']->value["OrderTime"]];?>

          <?php }?>
        </dd>
      </dl>
      <dl>
        <dt>伝票番号</dt>
        <dd>
          <?php if ($_SESSION['role'] == "admin") {?>
          <input type="text" name="SlipNumber" value="<?php echo $_smarty_tpl->tpl_vars['r']->value["SlipNumber"];?>
" class="date">
          <?php } else { ?>
          <?php echo $_smarty_tpl->tpl_vars['r']->value["SlipNumber"];?>

          <?php }?>
        </dd>
      </dl>
      <dl>
    </div>
  </div>
</div>
<?php if ($_SESSION['role'] == "admin") {?>
<div class="login-actions">
	<button class="button btn btn-primary btn-large">保存する</button>
</div> <!-- .actions -->
<?php }?>
<button type="button" class="button btn btn-close btn-large" data-dismiss="modal" aria-hidden="true">閉じる</button><?php }
}
