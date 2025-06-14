<?php
namespace Guozhijian611\ThinkOrmLog;

use support\Plugin;

/**
 * 插件安装
 */
class Install
{
    /**
     * 安装时触发
     * @return void
     */
    public static function install()
    {
        // 创建配置目录
        $configPath = config_path() . '/plugin/guozhijian611/thinkorm-log';
        if (!is_dir($configPath)) {
            mkdir($configPath, 0755, true);
        }

        // 复制配置文件
        $sourceConfigPath = __DIR__ . '/config/plugin/guozhijian611/thinkorm-log';
        if (is_dir($sourceConfigPath)) {
            copy_dir($sourceConfigPath, $configPath);
        }

        // 创建日志目录
        $logPath = runtime_path() . '/logs';
        if (!is_dir($logPath)) {
            mkdir($logPath, 0755, true);
        }

        echo "ThinkOrm日志插件安装完成！\n";
        echo "配置文件位置：{$configPath}/app.php\n";
        echo "日志文件位置：{$logPath}/sql.log, {$logPath}/api.log\n";
    }

    /**
     * 卸载时触发
     * @return void
     */
    public static function uninstall()
    {
        // 删除配置文件
        $configPath = config_path() . '/plugin/guozhijian611/thinkorm-log';
        if (is_dir($configPath)) {
            remove_dir($configPath);
        }

        echo "ThinkOrm日志插件卸载完成！\n";
    }

    /**
     * 更新时触发
     * @return void
     */
    public static function update()
    {
        // 更新配置文件
        $configPath = config_path() . '/plugin/guozhijian611/thinkorm-log';
        $sourceConfigPath = __DIR__ . '/config/plugin/guozhijian611/thinkorm-log';
        
        if (is_dir($sourceConfigPath)) {
            copy_dir($sourceConfigPath, $configPath);
        }

        echo "ThinkOrm日志插件更新完成！\n";
    }
}
