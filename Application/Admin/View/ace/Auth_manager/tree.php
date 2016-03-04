<volist name="tree" id="list">
<dl class="cate-item">
    <dt class="cf">
    <div class="fold"><i></i></div>
    <label>
        <div class="order">
            <label>
            <input class="cate_id ace" type="checkbox" name="cid[]" value="{$list.id}"><span class="lbl"></span>
            </label> 
        </div>
        <div class="name">
            <span class="tab-sign"></span>
            {$list.title}
            <span class="help-inline msg"></span>
        </div>
    </label>
    </dt>
    <notempty name="list['_']">
    <dd>
    {:R('AuthManager/tree', array($list['_']))}
    </dd>
    </notempty>
</dl>
</volist>
