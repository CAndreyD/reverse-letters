<?php

namespace App\Text;

function reverseLettersInWords(string $text): string
{
    // Ищем все слова и составные слова с дефисами/апострофами
    return preg_replace_callback(
        '/[\p{L}\p{M}]+(?:[-\'][\p{L}\p{M}]+)*/u',
        function ($matches) {
            // Берем найденное слово
            $word = $matches[0];

            // Разделяем слово на части по дефисам и апострофам
            // Например "third-part" → ["third", "-", "part"]
            $parts = preg_split('/([-\'’])/u', $word, -1, PREG_SPLIT_DELIM_CAPTURE);

            // Обрабатываем каждую часть отдельно
            foreach ($parts as &$part) {
                // Если часть содержит буквы
                if (preg_match('/[\p{L}\p{M}]+/u', $part)) {
                    // Разбиваем на отдельные буквы
                    $letters = preg_split('//u', $part, -1, PREG_SPLIT_NO_EMPTY);
                    // Переворачиваем буквы
                    $reversed = array_reverse($letters);

                    // Сохраняем правильный регистр (заглавные/строчные)
                    foreach ($letters as $i => $orig) {
                        if (mb_strtoupper($orig, 'UTF-8') === $orig) {
                            $reversed[$i] = mb_strtoupper($reversed[$i], 'UTF-8');
                        } else {
                            $reversed[$i] = mb_strtolower($reversed[$i], 'UTF-8');
                        }
                    }

                    // Собираем буквы обратно в часть слова
                    $part = implode('', $reversed);
                }
                // Если часть не буквы (дефис, апостроф), оставляем как есть
            }

            // Собираем все части обратно в слово
            return implode('', $parts);
        },
        $text
    );
}
