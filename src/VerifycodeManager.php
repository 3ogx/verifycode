<?php

namespace Cenzimo\Verifycode;

class VerifycodeManager {
    const VERSION = '0.1';
    const STATE_KEY = '_state';
    const DYNAMIC_RULE_KEY = '_dynamic_rule';
    const CAN_RESEND_UNTIL_KEY = '_can_resend_until';
    const VERIFY_SMS = 'verify_sms';
    const VERIFY_SMS_TEMPLATE_KEY = 'verifySmsTemplateId';
    const closurePattern = '/(SuperClosure\\\SerializableClosure)+/';

	protected static $storage;
	protected static $state = [];
	protected static $input = [];

	public function __construct(array $input = []) {
		$this->input = array_merge($this->input, $input);
    }
    
    public static function validateSendable() {
        return self::generateCode();
    }

    /**
     * 从存储器中获取可再次发送的截止时间
     *
     * @return int
     */
    public function getCanResendTime()
    {
        $key = $this->generateKey(self::CAN_RESEND_UNTIL_KEY);
        return (int) self::storage()->get($key, 0);
    }

	protected function reset() {
		$fields = self::getFields();
		$this->state = [];
	}

    /**
     * 合成结果数组
     *
     * todo 改为抛出异常,然后在控制器中catch
     *
     * @param bool   $pass
     * @param string $type
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    public static function generateResult($pass)
    {
        $result = [];
        $result['success'] = (bool) $pass;
        $result['code'] = self::generateCode();
        return $result;
    }

	/**
	 * 根据配置文件中的长度生成验证码
	 *
	 * @param int|null    $length
	 * @param string|null $characters
	 *
	 * @return string
	 */
	protected static function generateCode($length = null, $characters = null)
	{
        $length = (int) ($length ?: config('verifycode.verifyCode.length',
                config('verifycode.code.length', 5)));
        $characters = (string) ($characters ?: '0123456789');
        $charLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; ++$i) {
                $randomString .= $characters[mt_rand(0, $charLength - 1)];
        }
        return $randomString;
	}

    /**
     * 从配置文件获取验证码有效时间(分钟)
     *
     * @return int
     */
    protected static function getCodeValidMinutes()
    {
        return (int) config('verifycode.verifyCode.validMinutes', config('verifycode.code.validMinutes', 5));
    }
    
    /**
     * 序列化闭包
     *
     * @param \Closure $closure
     *
     * @return string
     */
    public static function closure(\Closure $closure)
    {
        return Util::serializeClosure($closure);
    }
}