<div id="OrderDetails" data-code="{$r["code"]}">
    {if $smarty.session.role == "admin"}
    <header class="OrderSheet">
      <h1>発注指示書をダウンロード</h1>
    </header>
    {/if}
  <div class="box">
    <header>
      <h1>基本情報</h1>
    </header>
    <div class="body">
      <dl>
        <dt>発注No</dt>
        <dd>{$r["code"]}</dd>
      </dl>
      <dl>
        <dt>発注日</dt>
        <dd>{$r["regist"]}</dd>
      </dl>
      <dl>
        <dt>ステータス</dt>
        <dd><span class="status status{$r["status_type"]}">{$r["status"]}</span></dd>
      </dl>
      <dl>
        <dt>更新日</dt>
        <dd>{$r["upd"]}</dd>
      </dl>
    </div>
  </div>
  {if $smarty.session.role == "admin"}
  <div class="box statusChange">
    
    <header>
      <h1>ステータスを変更する</h1>
    </header>
    <div class="body">
      <ul>
        {$next = $r["status_type"]+1}
        <li class="status status{$r["status_type"]}">{$r["status"]}</li>
        <li class="status status{$next}">{$OrderTable["status"]["item"][$next]}</li>
        <li class="status status5">{$OrderTable["status"]["item"][6]}</li>
      </ul>
    </div>
  </div>
  {else if $r["status_type"] == 0}
  <div class="box statusChange">
    <div class="body">
      <ul>
        <li class="status status{$r["status_type"]}">{$r["status"]}</li>
        <li class="status status5">{$OrderTable["status"]["item"][6]}する</li>
      </ul>
    </div>
  </div>
  {/if}
  <div class="box">
    <header>
      <h1>発注情報</h1>
    </header>
    <div class="body">
      <dl>
        <dt>注文ID</dt>
        <dd>{$r["title"]}</dd>
      </dl>
      <dl>
        <dt>発注名</dt>
        <dd>{$r["demo"]}</dd>
      </dl>
      <dl>
        <dt>ユーザ名</dt>
        <dd>{$r["user"]}</dd>
      </dl>
      <dl>
        <dt>企業名</dt>
        <dd>{$r["Company"]}</dd>
      </dl>
      <dl>
        <dt>配送先名</dt>
        <dd>{$r["adressName"]}</dd>
      </dl>
      <dl>
        <dt>送付先住所</dt>
        <dd>{$r["adress"]}</dd>
      </dl>
      <dl>
        <dt>送付先TEL</dt>
        <dd>{$r["adressTel"]}</dd>
      </dl>
      <dl>
        <dt>送付先TEL</dt>
        <dd>{$r["adressTel"]}</dd>
      </dl>
    </div>  
  </div>
  <div class="box itemns">
    <header>
      <h1>受注詳細</h1>
    </header>
    <div class="body">
    {foreach from=$r["sets"] key=ks item=vs}
      <div class="items sets">
        <div class="ttl">SET</div>
        <div class="img"><img src="{_IMG_}{if !empty($vs[0]["img"])}{$vs[0]["img"]}{else}nowprinting.jpg{/if}"></div>
        <div class="title">{$vs[0]["title"]}</div>
        <div class="num">{$vs[0]["number"]}セット</div>
      </div>
    {/foreach}
    {foreach from=$r["items"] key=ks item=vs}
      <div class="items">
        <div class="ttl">単品商品</div>
        <div class="img"><img src="{_IMG_}{if !empty($vs[0]["img"])}{$vs[0]["img"]}{else}nowprinting.jpg{/if}"></div>
        <div class="title">{$vs[0]["name"]}</div>
        <div class="num">{$vs[0]["number"]}{$unit["unit"]["item"][$vs[0]["unit"]]}</div>
      </div>
    {/foreach}
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
          {if $smarty.session.role == "admin"}
          <input type="text" name="OrderDate" id="OrderDate" value="{$r["OrderDate"]}" class="date modalInner">
          {else}
          {$r["OrderDate"]}
          {/if}
        </dd>
      </dl>
      <dl>
        <dt>デモ実施日</dt>
        <dd>
          {if $smarty.session.role == "admin"}
          <input type="text" name="OrderImplementation" id="OrderImplementation" value="{$r["OrderImplementation"]}" class="date modalInner">
          {else}
          {$r["OrderImplementation"]}
          {/if}
        </dd>
      </dl>
      <dl>
        <dt>配送指定時間</dt>
        <dd>
          {if $smarty.session.role == "admin"}
          <select name="OrderTime">
            <option>選択</option>
            {foreach from=$OrderTime key=ks item=vs}
            <option value="{$ks}"{if $r["OrderTime"]==$ks} selected="selected"{/if}>{$vs}</option>
            {/foreach}
          </select>
          {else}
          {$OrderTime[$r["OrderTime"]]}
          {/if}
        </dd>
      </dl>
      <dl>
        <dt>伝票番号</dt>
        <dd>
          {if $smarty.session.role == "admin"}
          <input type="text" name="SlipNumber" value="{$r["SlipNumber"]}" class="date">
          {else}
          {$r["SlipNumber"]}
          {/if}
        </dd>
      </dl>
      <dl>
    </div>
  </div>
</div>
{if $smarty.session.role == "admin"}
<div class="login-actions">
	<button class="button btn btn-primary btn-large">保存する</button>
</div> <!-- .actions -->
{/if}
<button type="button" class="button btn btn-close btn-large" data-dismiss="modal" aria-hidden="true">閉じる</button>