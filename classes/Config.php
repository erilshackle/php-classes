<?php

final class Config
{
    private static $config = null;
    public static function get(string $key, mixed $default = null): mixed
    {
        if (self::$config === null) {
            self::$config = self::load('settings');
        }

        $configKey = strtolower($key);
        $configKeys = explode('.', $configKey);
        $configValue = self::$config;

        foreach ($configKeys as $configKeyPart) {
            if (is_array($configValue) && array_key_exists($configKeyPart, $configValue)) {
                $configValue = $configValue[$configKeyPart];
            } else {
                return $default;
            }
        }

        return $configValue ?? $default;
    }

    public static function load(string $cfgFile, bool $required = true): array
    {
        $cfgFile = str_replace('.php', '', $cfgFile);
        if (!file_exists($file = PATH_CONFIGS . "/$cfgFile.php")) {
            return $required ? (throw new Exception('Arquivo de configuração não encontrado: ' . $cfgFile)) : [];
        }
        return include $file;
    }
}
