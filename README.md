# uark-quiz

這是一道諾亞克科技股份有限公司的測驗題。

## 技術棧

這個專案使用以下工具：

* PHP ^8.1
* Laravel ^10.10
* MySQL 8
* Vue.js 3
* Tailwind CSS
* Vite 5

## 啟動專案

要在本地運行這個專案，請依以下步驟：

0. 請先確認以下工具已安裝，或使用 Docker 環境：
* git
* PHP ^8.1
* Composer ^2.7
* bun ^1.3
* MySQL 或 MariaDB

1. 下載專案到本地：
```bash
git clone git@github.com:shiangogo/uark-quiz.git
```

2. 安裝所需的套件：
```bash
cd uark-quiz
composer install
bun install
```

3. 將 `.env.example` 複製一份為 `.env`，並設定環境變數：
```bash
cp .env.example .env
```

4. 創建資料庫並進行遷移：
```bash
php artisan migrate
```

5. 打包編譯前端程式碼：
```bash
bun run build
# 若需要使用開發用伺服器可執行 bun run dev
```

6. 運行伺服器：
```bash
php artisan serve
```
