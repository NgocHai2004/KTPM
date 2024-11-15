<?php
use PHPUnit\Framework\TestCase;

class ExampleAssertionsTest extends TestCase
{
    // Kiểm thử so sánh chuỗi chính xác và kiểm tra chi tiết sự khác biệt giữa các chuỗi
    public function testThatStringsMatch()
    {
        $string1 = 'testing';  // Khởi tạo chuỗi 1
        $string2 = 'testing';  // Khởi tạo chuỗi 2
        $string3 = 'Testing';  // Khởi tạo chuỗi 3 (chú ý chữ hoa chữ thường)

        // Kiểm tra sự giống hệt của $string1 và $string2 (cùng giá trị và kiểu)
        $this->assertSame($string1, $string2);  // Kỳ vọng thành công vì cả giá trị và kiểu đều giống nhau

        // Kiểm tra trường hợp so sánh chuỗi với chữ hoa chữ thường khác nhau
        $this->assertNotSame($string1, $string3);  // Kỳ vọng thất bại vì có sự khác biệt về chữ hoa chữ thường

        // Kiểm tra chuỗi có thể chuyển thành chữ thường hay không (ví dụ kiểm tra so sánh không phân biệt chữ hoa chữ thường)
        $this->assertEquals(strtolower($string1), strtolower($string3));  // Kỳ vọng thành công vì chuyển đổi về chữ thường và so sánh lại
    }

    // Kiểm thử việc cộng các số và kiểm tra chi tiết
    public function testThatNumbersAddUp()
    {
        // Kiểm tra kết quả cộng các số đơn giản
        $this->assertEquals(10, 5 + 5);  // Kỳ vọng thành công vì 5 + 5 = 10

        // Kiểm tra cộng với giá trị âm và đảm bảo rằng phép cộng hoạt động chính xác
        $this->assertEquals(0, 5 + -5);  // Kỳ vọng thành công vì 5 + (-5) = 0

        // Kiểm tra cộng với giá trị 0, xác nhận rằng không có sự thay đổi giá trị
        $this->assertEquals(5, 5 + 0);  // Kỳ vọng thành công vì 5 + 0 = 5

        // Kiểm tra cộng các số lớn và đảm bảo rằng phép cộng thực hiện chính xác
        $this->assertEquals(1000000, 500000 + 500000);  // Kỳ vọng thành công vì 500000 + 500000 = 1000000

        // Kiểm tra sự cộng của các giá trị thập phân
        $this->assertEquals(7.5, 3.5 + 4);  // Kỳ vọng thành công vì 3.5 + 4 = 7.5
    }
}
?>