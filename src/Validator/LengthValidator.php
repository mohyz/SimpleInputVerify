<?php
/**
 * Created by PhpStorm.
 * User: mohyz
 * Date: 2018/5/13
 * Time: 18:04
 */

namespace Mohyz\Validator;


use Mohyz\ValidatorException;

class LengthValidator extends AbstractValidator
{

    /**
     * @return VerifyResult
     * @throws ValidatorException
     */
    public function verify()
    {

        $argsCount = count($this->args);
        if ($argsCount == 0 || $argsCount > 3) {
            throw new ValidatorException("length validator args error");
        }

        $strLen = strlen($this->value);

        if ($argsCount == 1) {

            if ($strLen === intval($this->args[0])) {
                return new VerifyResult(true);
            } else {
                return new VerifyResult(false, $this->errorMsgReplace($this->errorMsg[0], $this->args[0]));
            }
        } else {

            if ($strLen < $this->args[0]) {

                return new VerifyResult(false, $this->errorMsgReplace($this->errorMsg[1], $this->args[1]));

            }

            if ($strLen > $this->args[1]) {

                return new VerifyResult(false, $this->errorMsgReplace($this->errorMsg[2], $this->args[2]));

            }

            return new VerifyResult(true);

        }


    }


    /**
     * @param $msg
     * @param $args
     * @return mixed
     */
    protected function errorMsgReplace($msg, $args)
    {
        $msg = parent::errorMsgReplace($msg); // TODO: Change the autogenerated stub
        return str_replace("{args}", $args, $msg);
    }

}