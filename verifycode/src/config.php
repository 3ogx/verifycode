<?php
return [
	'options' => [],

    /**
     * 请求间隔
     * 单位：秒
     */
	'interval' => 60,

    /**
     * 验证码管理
     * 
     * length        验证码长度
     * validMinutes  验证码有效时间长度，单位为分钟
     * repeatIfValid 如果原验证码还有效，是否重复使用原验证码
     * maxAttempts   验证码最大尝试验证次数，超过该数值验证码自动失效，0或负数则不启用
     */
	'code' => [
		'length'        => 5,
		'validMinutes'  => 5,
		'repeatIfValid' => false,
		'maxAttempts'   => 0,
	],
];