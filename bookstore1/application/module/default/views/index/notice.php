<?php

	$message 	= '';
	if(isset($this->arrParam['type'])){
		switch($this->arrParam['type']) {
			case 'register-success':
				$message 		= 'Tài Khoản của bạn đã được tạo thành công. Xin vui lòng chờ kích hoạt từ quản trị !';
				break;
	
			case 'not-permission':
				$message 		= 'Bạn không có quyền truy cập vào chức năng đó !';
				break;
			
				case 'not-url':
				$message 		= 'Đường dẫn không hợp lệ !';
				break;
		}
	}
	

?>
<div class="notice"><?php echo $message; ?></div>