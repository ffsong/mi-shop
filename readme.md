#### 使用步骤

* 拉取项目

    ` git clone {仓库地址} `

* 安装项目依赖

    切换composer源加速 `composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/`

    安装 `composer install`

* 安装 Nodejs 依赖

    配置镜像加速 `yarn config set registry https://registry.npm.taobao.org`
    yarn 命令安装 Nodejs 依赖 `SASS_BINARY_SITE=http://npm.taobao.org/mirrors/node-sass yarn`
    编译前端代码 `yarn dev`
    
* 配置 .env 文件

    复制文件 `cp .env.example .env` 修改数据库配置等
    
    自动生成 APP_KEY 值 `php artisan key:generate`
    
* 创建软链

    需要在 public 目录下创建一个连到 storage/app/public 目录下的软链接 `php artisan storage:link`
    
* 初始化数据库

    运行迁移 `php artisan migrate`
     
    然后导入管理后台数据 `  mysql -u{用户名} -p{密码} { 数据库名 } < database/admin.sql`