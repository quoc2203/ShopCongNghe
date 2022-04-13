<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'shopcongnghe' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '7[f0-V%4)%qb?eq/>!y?uXQ&/~Qr|i&uf`bD4.!#%_V];z]IiK6(6C(Pg$*PnR!e' );
define( 'SECURE_AUTH_KEY',  'c5#(a=Q(zT@BFB1x~K*R]S=!+`K1st0uVz}+dp:CnpATo@tIK5<o>Xj]l#*#hwRC' );
define( 'LOGGED_IN_KEY',    's4ATU~gih~b>E${KkVMe0X?oG^LAo*?u!>]oETIEb;0t!^L5#7f*o|qpH&i;Fy<s' );
define( 'NONCE_KEY',        'Em?g{?J6_qCu4B#FuGmkQU27(q?}ZxZQBC0{{rDCo yjV6Dr_b74F&G#5F)a/ s ' );
define( 'AUTH_SALT',        'uaR]J*%Vzz4w1{3FJGkTiELn3t=5qhmA&xjB#9Q|A2spHg}Y-H`i-p?M*)CKe@tW' );
define( 'SECURE_AUTH_SALT', 'JOZgqAjjl6N|^7x]=I)P#8zdWy;I%dCJRgm(cN4oui^9w?j3PpmoSFLM.5,7rfi8' );
define( 'LOGGED_IN_SALT',   ']yd/ {Uvp.[zh,4Nv!9R$76|[D+=i~KbQz}09 .byvZmGryF#CgvStQAfzhv*Y^f' );
define( 'NONCE_SALT',       'xpel)>i^S7_R-=~.d()aps:qdm[O>]]Ep2MN+zwF2B+YE7eg8H$N>F))jL!Elvx#' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'shop_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
define('FS_METHOD', 'direct');
define('FS_CHMOD_DIR', (0755 & ~ umask()));
define('FS_CHMOD_FILE', (0644 & ~ umask()));
