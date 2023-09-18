<div id="form_div1">
	<div class="form-group">
	    <div class="contact_rows">
			<div>
	  			회사명<i class="icon-required" aria-hidden="true"></i><input type="text" class="form-control" id="contact_comp" name="contact_comp" onchange="chkSpaceFe(this)">
			</div>
			<div>
				연락처<i class="icon-required" aria-hidden="true"></i> 
				<div class="telnum_div">
		  			<input type="tel" maxlength="4" class="form-control inline-blocked" name="tel1" id="tel1" autocomplete="off" onkeydown="onlyNum(this)" onchange="chkSpaceFe(this)">
		  			<span class="inline-blocked line">-</span>
		  			<input type="tel" maxlength="4" class="form-control inline-blocked" name="tel2" id="tel2" autocomplete="off" onkeydown="onlyNum(this)" onchange="chkSpaceFe(this)">
		  			<span class="inline-blocked line">-</span>
		  			<input type="tel" maxlength="4" class="form-control inline-blocked" name="tel3" id="tel3" autocomplete="off" onkeydown="onlyNum(this)" onchange="chkSpaceFe(this)">
	  			</div>	
			  
			</div>
		</div>
	</div>
  	<div class="form-group">
  	    <div class="contact_rows">
			<div>
				이름<i class="icon-required" aria-hidden="true"></i><input type="text" class="form-control" id="contact_name" name="contact_name" onchange="chkSpaceFe(this)">
			</div>
			<div>
			  직책<input type="text" class="form-control" id="contact_position" name="contact_position" onchange="chkSpaceFe(this)">
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="contact_rows">
			<div>
          <div class="form-group">
	    			이메일<i class="icon-required" aria-hidden="true"></i> <input type="text" class="form-control" name="contact_email" id="contact_email" onchange="chkSpaceFe(this)">
          </div>
			</div>
		</div>
	</div>
	<div class="form-group type_div">
		<label for class="control-label">유형</label><i class="icon-required" aria-hidden="true"></i>
	    <input type="checkbox" name="type_check[]" value="글로벌 크라우드 펀딩" >펀딩
	    <input type="checkbox" name="type_check[]" value="글로벌 프리오더" >프리오더
	    <input type="checkbox" name="type_check[]" value="글로벌 콘텐츠 마케팅" >마케팅
	    <input type="checkbox" name="type_check[]" value="글로벌 디지털 마케팅" >마케팅
	    <input type="checkbox" name="type_check[]" value="글로벌 커머스" >커머스
	    <input type="checkbox" name="type_check[]" value="전시회/팝업스토어/B.ring" >전시회 / 팝업스토어
	    <input type="checkbox" name="type_check[]" value="수출/혁신 바우처" >디지털무역
	    <input type="checkbox" name="type_check[]" value="기타" >기타
      
      <div class="chkbox_rows">
        <div class="chk_tgroup" onclick="chk_tgroup(1,1)">글로벌 크라우드 펀딩</div>
        <div class="chk_tgroup" onclick="chk_tgroup(1,2)">글로벌 프리오더</div>
        <div class="chk_tgroup" onclick="chk_tgroup(1,3)">글로벌 콘텐츠 마케팅</div>
        <div class="chk_tgroup" onclick="chk_tgroup(1,4)">글로벌 디지털 마케팅</div>
        <div class="chk_tgroup" onclick="chk_tgroup(1,5)">글로벌 커머스</div>
        <div class="chk_tgroup" onclick="chk_tgroup(1,6)">전시회/팝업스토어/B.ring</div>
        <div class="chk_tgroup" onclick="chk_tgroup(1,7)">기타</div>
      </div>
      
      
	</div>

	<div class="form-group smok_div">
	    <label for class="control-label">서비스 이용 목적</label>
	    <input type="checkbox" name="smok[]" value="브랜드 인지도 향상" >브랜드 인지도 향상
	    <input type="checkbox" name="smok[]" value="시장 개척" >시장 개척
	    <input type="checkbox" name="smok[]" value="판매 증가" >판매 증가
	    <input type="checkbox" name="smok[]" value="광고효율 증대" >광고효율 증대
	    <input type="checkbox" name="smok[]" value="기타" >기타
      
      <div class="chkbox_rows">
        <div class="chk_smok" onclick="chk_tgroup(2,1)">브랜드 인지도 향상</div>
        <div class="chk_smok" onclick="chk_tgroup(2,2)">시장 개척</div>
        <div class="chk_smok" onclick="chk_tgroup(2,3)">판매 증가</div>
        <div class="chk_smok" onclick="chk_tgroup(2,4)">광고효율 증대</div>
        <div class="chk_smok" onclick="chk_tgroup(2,5)">기타</div>
      </div>
	</div>

  
  	<div class="form-group">
	    <label for class="control-label">예산</label>
	    <select class="form-control" id="contact_money">
			<option value="" selected>(선택)</option>
			<option value="미정">미정</option>
			<option value="~100만">~100만</option>
			<option value="100만~1000만">100만~1000만</option>
			<option value="1000만~5000만">1000만~5000만</option>
			<option value="5000만~1억">5000만~1억</option>
			<option value="1억이상">1억이상</option>
	    </select>
  	</div>
	
  	<div class="form-group">
	    <label for class="control-label">일정</label>
	    <select class="form-control" id="contact_sche">
			<option value="" selected>(선택)</option>
			<option value="1주">1주</option>
			<option value="한달">한달</option>
			<option value="반년">반년</option>
			<option value="일년">일년</option>
			<option value="일년이상">일년이상</option>
			<option value="계획없음">계획없음</option>
	    </select>
  	</div>

	<div class="form-group">
	  	내용 <textarea class="form-control" rows="3" id="contact_cont" name="contact_cont" onchange="chkSpaceFe(this)"></textarea>
	</div>	
	<div class="form-group btn_div">
		<input type="button" value="등록" class="regbtn" onclick="setContactFormData()" >
	</div>
</div>