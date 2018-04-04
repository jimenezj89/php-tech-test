<?php

namespace TechTest\Part2\Application;

use TechTest\Part2\Models\InputParamsValidator;

final class SanitizeDataFromRequest
{
    private $dataToSanitize;

    public function __construct(array $someDataToSanitize)
    {
        $this->dataToSanitize = $someDataToSanitize;
    }

    public function getSanitizedData(): array
    {
        $inputParamValidator = new InputParamsValidator($this->dataToSanitize);
        $inputParamValidator->validate();

        return $this->sanitizeData();
    }

    private function sanitizeData()
    {
        $sanitizedData = [];

        foreach ($this->dataToSanitize as $param) {
            array_push($sanitizedData, [
                $param['name'] => $param['value']
            ]);
        }

        return $sanitizedData;
    }
}