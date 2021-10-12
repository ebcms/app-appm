{include common/header@ebcms/admin}
<div class="mb-4 mt-3">
    <div class="fs-3 mb-2 border-bottom border-2 border-dark pb-2 text-dark">应用管理</div>
    <div class="text-muted fw-light">可以启用或者停用已经安装的应用</div>
</div>
<script>
    function disable(name, disabled) {
        $.ajax({
            type: "POST",
            url: "{:$router->buildUrl('/ebcms/appm/disable')}",
            data: {
                name: name,
                disabled: disabled
            },
            dataType: "JSON",
            success: function(response) {
                if (!response.code) {
                    alert(response.message);
                } else {
                    location.reload();
                    // parent.location.reload();
                }
            },
            error: function() {
                alert('发生错误~');
            }
        });
    }
</script>
{foreach $packages as $vo}
<div class="mb-3 pb-3 d-flex">
    <div>▪</div>
    <div class="ms-2">
        <div class="mb-2">
            <div class="text-dark fw-light h5">{$vo.name}<small class="text-muted ms-2">{$vo.version_normalized}</small></div>
        </div>
        <div class="text-muted mb-2">
            <small>{$vo.description}</small>
        </div>
        <div>
            {if $vo['_disabled']}
            {if $vo['_enable']}
            <button class="btn btn-outline-info btn-sm" onclick="disable('{$vo.name}','0');" data-bs-toggle="tooltip" title="应用已停用，点此切换">已禁用</button>
            {else}
            <button class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" title="若要启用此应用，请先启用[{$vo._enable_name}]">已禁用</button>
            {/if}
            {else}
            {if $vo['_disable']}
            <button class="btn btn-outline-primary btn-sm" onclick="disable('{$vo.name}', '1');" data-bs-toggle="tooltip" title="应用运行中，点此切换">运行中</button>
            {else}
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="若要禁用此应用，请先禁用[{$vo._disable_name}]">运行中</button>
            {/if}
            {/if}
        </div>
    </div>
</div>
{/foreach}
{include common/footer@ebcms/admin}