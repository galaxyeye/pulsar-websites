<style>
<!--
.view dd table th { border : none; width : 4em;}
-->
</style>

<div class="message view">
    <h4 style="font-size: 16px;">帮助说明<a>（展开）</a></h4>    
    <dl class="hidden"><?php $i = 0;
        $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>>冒号":"</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
        	field:value结构查询，表示字段field值为value的查询。如：domain:tianya.com仅查询tianya.com域名下的内容。
        	（系统目前包含的字段有：domain, url, title, text, 其他字段在添加中）
        	&nbsp;
       	</dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>>通配符</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
        	? - 任意一个字符<br />
        	* - 任意字符
        	&nbsp;
       	</dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>>布尔操作</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
        	<table cellpadding="0" cellspacing="0">
        		<tr>
        			<th>AND</th>
        			<td>并且</td>
        		</tr>
        		<tr>
        			<th>OR</th>
        			<td>或者</td>
        		</tr>
        		<tr>
        			<th>+</th>
        			<td>包含</td>
        		</tr>
        		<tr>
        			<th>-</th>
        			<td>不包含</td>
        		</tr>
        		<tr>
        			<th>NOT</th>
        			<td>否定</td>
        		</tr>
        	</table>
        	<div>注意AND、OR、NOT均为大写</div>
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>>子运算</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
	        ()括号跟数学表达式上的差不多，比如：("李克强" OR "汪洋") AND "视察"
        	&nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>>控制相关度</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
	        ^表示相关度，如检索"国务院 侨办"，同时希望让"侨办"的相关度更加好，那么在其后加上”^”符号和增量值，即("国务院" "侨办"^4)
        	&nbsp;
        </dd>
		<!-- 
        <dt<?php if ($i % 2 == 0) echo $class; ?>>范围</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
	        [A TO B] 从A到B之间，包含A和B,注意TO大写<br />
	        {A TO B} 从A到B之间，不包含A和B,注意TO大写
        	&nbsp;
        </dd>        
        <dt<?php if ($i % 2 == 0) echo $class; ?>>模糊检索</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
	        ~表示模糊检索，比如：roam~将找到形如foam和roams的单词；roam~0.8，检索返回相似度在0.8以上的记录
        	&nbsp;
        </dd>
         -->
    </dl>
</div>
