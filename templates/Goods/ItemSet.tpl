{include file="head.tpl"}
{include file="header.tpl"}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
{include file="Search.tpl"}
    <button class="btn green" id="" onclick="location.href='{_BASE_URL_}/Goods/SetRegister'"><i class="fa fa-check"></i>新規登録</button>
    <div id="SearchResult" class="widget-table action-table">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>No.</th>
            <th>セット商品名</th>
            <th>画像</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <ul class="pagination">
        <li class="prev"><a href="#" title="First"><i class="fa fa-angle-double-left"></i></a></li>
        <li class="next"><a href="#" title="Last"><i class="fa fa-angle-double-right"></i></a></li>
      </ul>
    </div>

    </div>
  </div>
</div>


<style>
.modal{
width: 80%;
left: 10%;
margin-left: 0;
}

.login-fields{
display: flex;
flex-wrap: wrap;
}

.login-fields .field{
width: 30%;
}

.login-fields .field.text,
.login-fields .field.image,
.login-fields .field.textarea{
width: 100%;
}

.login-fields .field.textarea textarea{
height: 100px;
}
</style>

<script>
  var InsertSetUrls = '{_BASE_URL_}/Goods/SetRegister';
</script>
<script src="{_BASE_URL_}/js/SetItemForm.js"></script>
{include file="footer.tpl"}
{include file="foot.tpl"}