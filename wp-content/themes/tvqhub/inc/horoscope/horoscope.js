// Khai báo jQuery trong WP, tham số $ trong function như con trỏ this
jQuery(function ($) {
    $("#thang").on('change', function () {
        var thang = this.value;
        var htmlNgay = '<option value="0" selected>----Ngày----</option>';
        var n = 1;
        switch (parseInt(thang)) {
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                n = 31;
                break;
            case 4:
            case 6:
            case 9:
            case 11:
                n = 30;
                break;
            default:
                n = 29;
                break;
        }
        for (var i = 1; i <= n; i++) {
            htmlNgay += '<option value="' + i + '">' + i + '</option>';
        }
        $("#ngay").html(htmlNgay);
    });

    var chomSao = {
        hinh: null,
        ten: null,
        ngay: null,
        moTa: null,
        init: function () {
            this.xemEvent();
        },
        xemEvent: function () {
            $("#xem").off('click').on('click', function () {
                thang = parseInt($("#thang").val());
                ngay = parseInt($("#ngay").val());
                if (thang == 0 || ngay == 0) {
                    $("#error").removeClass('d-none').addClass('d-block');
                    $("#thong-tin").removeClass('d-block').addClass('d-none');
                } else {
                    chomSao.TimChomSao(thang, ngay);
                    $("#error").removeClass('d-block').addClass('d-none');
                    $("#thong-tin").removeClass('d-none').addClass('d-block');
                }
            });
        },

        TimChomSao: function (thang, ngay) {
            switch (thang) {
                case 1:
                    if (ngay <= 19)
                        this.ChomSao("MaKet");
                    else
                        this.ChomSao("BaoBinh");
                    break;
                case 2:
                    if (ngay <= 18)
                        this.ChomSao("BaoBinh");
                    else
                        this.ChomSao("SongNgu");
                    break;
                case 3:
                    if (ngay <= 20)
                        this.ChomSao("SongNgu");
                    else
                        this.ChomSao("BachDuong");
                    break;
                case 4:
                    if (ngay <= 19)
                        this.ChomSao("BachDuong");
                    else
                        this.ChomSao("KimNguu");
                    break;
                case 5:
                    if (ngay <= 20)
                        this.ChomSao("KimNguu");
                    else
                        this.ChomSao("SongTu");
                    break;
                case 6:
                    if (ngay <= 21)
                        this.ChomSao("SongTu");
                    else
                        this.ChomSao("CuGiai");
                    break;
                case 7:
                    if (ngay <= 22)
                        this.ChomSao("CuGiai");
                    else
                        this.ChomSao("SuTu");
                    break;
                case 8:
                    if (ngay <= 22)
                        this.ChomSao("SuTu");
                    else
                        this.ChomSao("XuNu");
                    break;
                case 9:
                    if (ngay <= 22)
                        this.ChomSao("XuNu");
                    else
                        this.ChomSao("ThienBinh");
                    break;
                case 10:
                    if (ngay <= 23)
                        this.ChomSao("ThienBinh");
                    else
                        this.ChomSao("ThienYet");
                    break;
                case 11:
                    if (ngay <= 21)
                        this.ChomSao("ThienYet");
                    else
                        this.ChomSao("NhanMa");
                    break;
                case 12:
                    if (ngay <= 21)
                        this.ChomSao("NhanMa");
                    else
                        this.ChomSao("MaKet");
                    break;
            }
        },

        ChomSao: function (tenChomSao) {
            switch (tenChomSao) {
                case "MaKet":
                    this.hinh = "2651";
                    this.ten = "Ma Kết (Capricorn)";
                    this.ngay = "22/12 - 19/1";
                    this.moTa = "Đầy tham vọng, ý thức tổ chức tốt, kỷ luật, cứng nhắc, tiết kiệm, thận trọng, bảo thủ, có trách nhiệm, thiết thực, kiên trì, luôn xác định mục tiêu rõ ràng, có khả năng lên và sắp xếp kế hoạch tốt, thích hợp chính trị.";
                    break;
                case "BaoBinh":
                    this.hinh = "2652";
                    this.ten = "Bảo Bình (Aquarius)";
                    this.ngay = "20/1 - 18/2";
                    this.moTa = "Chủ nghĩa cá nhân, không theo quy chuẩn, tư tưởng tiến bộ, độc đáo, độc lập, nhân đạo, vị tha, nhìn xa trông rộng, sâu sắc, trí tuệ, khéo léo, sáng tạo, không thể đoán trước, lúc thân thiện lúc hơi lánh đời.";
                    break;
                case "SongNgu":
                    this.hinh = "2653";
                    this.ten = "Song Ngư (Pisces)";
                    this.ngay = "19/2 - 20/3";
                    this.moTa = "Hay có những cảm giác khác thường, ấn tượng, yêu hoà bình, nghiêm trọng hóa vấn đề, thông cảm, từ bi, yêu nghệ thuật, thích sáng tạo mơ mộng, trí tưởng tượng phong phú, tận tụy, nhút nhát, sống nội tâm, quan trọng tinh thần, không quan trọng vật chất.";
                    break;
                case "BachDuong":
                    this.hinh = "2648";
                    this.ten = "Bạch Dương (Aries)";
                    this.ngay = "21/3 - 19/4";
                    this.moTa = "Năng động, sáng tạo, tiên phong, quyết đoán, mạnh mẽ, nhà lãnh đạo đầy tham vọng, hướng ngoại, cạnh tranh, nhiệt tình, tự lực, tự tin. Tuy nhiên hay nhanh nhẩu đoảng.";
                    break;
                case "KimNguu":
                    this.hinh = "2649";
                    this.ten = "Kim Ngưu (Taurus)";
                    this.ngay = "20/4 - 20/5";
                    this.moTa = "Cứng đầu, thận trọng, điềm tĩnh, kiên trì, lâu dài, hướng nội, bảo thủ, ổn định, siêng năng, đáng tin cậy, quan trọng vật chất, và thường có khả năng tài chính đáng kể.";
                    break;
                case "SongTu":
                    this.hinh = "264a";
                    this.ten = "Song Tử (Gemini)";
                    this.ngay = "21/5 - 21/6";
                    this.moTa = "Thay đổi linh hoạt, nhạy bén, đa năng, sống động, tỉnh táo, khả năng giao tiếp, hòa đồng, khéo léo, nhanh nhẹn, trí tuệ, và tinh thần đầy tham vọng. Thích hợp với mọi ngành nghề.";
                    break;
                case "CuGiai":
                    this.hinh = "264b";
                    this.ten = "Cự Giải (Cancer)";
                    this.ngay = "22/6 - 22/7";
                    this.moTa = "Sống nội tâm, nhạy cảm, u sầu, cảm thông, thận trọng, biết giữ bí mật, ỷ lại, bình tĩnh, trí tưởng tượng phong phú, tận tâm, và khá truyền thống.";
                    break;
                case "SuTu":
                    this.hinh = "264c";
                    this.ten = "Sư Tử (Leo)";
                    this.ngay = "23/7 - 22/8";
                    this.moTa = "Đầy tham vọng, một người yêu ánh đèn sân khấu,thích đầu cơ, hướng ngoại, lạc quan, đáng kính, trang nghiêm, tự tin, cởi mở, rực rỡ, lôi cuốn, kịch tính, cạnh tranh, có bản năng là một nhà lãnh đạo.";
                    break;
                case "XuNu":
                    this.hinh = "264d";
                    this.ten = "Xử Nữ (Virgo)";
                    this.ngay = "23/8 - 22/9";
                    this.moTa = "Thực tế, có trách nhiệm, hay phân tích, phân biệt đối xử, lập kế hoạch cẩn thận, chính xác và đúng giờ, tận tụy, chủ nghĩa hoàn hảo, hay chỉ trích, có ý thức giữ gìn sức khỏe, và hơi hướng nội.";
                    break;
                case "ThienBinh":
                    this.hinh = "264e";
                    this.ten = "Thiên Bình (Libra)";
                    this.ngay = "23/9 - 23/10";
                    this.moTa = "Một sứ giả hòa bình,có tài ngoại giao, duyên dáng, tao nhã, lịch sự, đầu óc công bằng, hòa đồng, yêu nghệ thuật sáng tạo, thân thiện, hướng ngoại, và thường hơi thiếu quyết đoán.";
                    break;
                case "ThienYet":
                    this.hinh = "264f";
                    this.ten = "Thiên Yết (Scorpio)";
                    this.ngay = "24/10 - 21/11";
                    this.moTa = "Sâu sắc, mạnh mẽ, táo bạo, can đảm, bền vững, cạnh tranh, nhà nghiên cứu xuất sắc, tháo vát, thám tử tài ba, bí ẩn, sắc sảo, tự lực cánh sinh, trầm lặng, hướng nội.";
                    break;
                case "NhanMa":
                    this.hinh = "2650";
                    this.ten = "Nhân Mã (Sagittarius)";
                    this.ngay = "22/11 - 21/12";
                    this.moTa = "Lạc quan, yêu tự do, giản dị, thân thiện, sôi động, thích giao du, nhiệt tình, hiếu học, nhìn xa trông rộng, thẳng thắn, trung thực, trung thành, hiếu động và thích du lịch.";
                    break;
            }
            // Display html
            $("img.sticker").attr("src", "https://s.w.org/images/core/emoji/2.4/svg/" + this.hinh + ".svg");
            $("#ten-chom-sao").html(this.ten);
            $("#ngay-sinh").html(this.ngay);
            $("#mo-ta").html(this.moTa);
        }

    };
    chomSao.init();
});