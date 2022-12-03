{include file="head.tpl"}
{include file="header.tpl"}
{include file="User/nav.tpl"}


<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
{include file="Search.tpl"}


        <div class="widget-table action-table scroll-table">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
          {foreach from=$OrderView key=k item=v}
              {if $v["view"] == 1}
                <th class="{$k}">{$v["name"]}</th>
              {/if}
          {/foreach}
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

    </div>
  </div>
</div>

<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"></h4>
      </div>
    </div>
    <div class="modal-body">
      <div class="form-body">
      </div>
    </div>
  </div>
</div>
{$t = time()}
<script>
  var ResultTarget = "table tbody";
  var templ = "Order";
</script>
<script src="{_BASE_URL_}/js/OrderManagement.js?{$t}"></script>
<link rel="stylesheet" href="{_BASE_URL_}/css/Order/Management.css?{$t}">

{include file="foot.tpl"}
{include file="footer.tpl"}