<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Examination;

class Year implements Rule
{
    /**
     * ユーザーID
     * @var int
     */
    protected $userid;

    /**
     * Create a new rule instance.
     *
     * @param int $userid ユーザーID
     * @return void
     */
    public function __construct($userid)
    {
        $this->userid = $userid;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // 受診日とユーザーIDを条件に同年度のデータがあるかチェック
        return (new Examination)->validateYear($value, $this->userid);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'すでに同年度に受診記録が登録されています';
    }
}
