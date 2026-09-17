document.addEventListener("DOMContentLoaded", () => {
 const form=document.getElementById("chatForm");
 const input=document.getElementById("question");
 const box=document.getElementById("chatMessages");
 if(form){
  form.addEventListener("submit", async e=>{
   e.preventDefault(); const q=input.value.trim(); if(!q)return;
   box.insertAdjacentHTML("beforeend", `<div class="message user"><strong>You</strong><p>${escapeHtml(q)}</p></div>`);
   input.value="";
   const fd=new FormData(); fd.append("question",q);
   try{
    const r=await fetch("api_chat.php",{method:"POST",body:fd}); const data=await r.json();
    box.insertAdjacentHTML("beforeend", `<div class="message assistant"><strong>MISA</strong><p>${data.answer}</p></div>`);
   }catch(err){box.insertAdjacentHTML("beforeend", `<div class="message assistant"><strong>MISA</strong><p>Something went wrong. Please try again.</p></div>`);}
   box.scrollTop=box.scrollHeight;
  });
 }
 document.querySelectorAll(".suggestions button").forEach(b=>b.addEventListener("click",()=>{input.value=b.dataset.q;form.dispatchEvent(new Event("submit"));}));
});
function escapeHtml(s){return s.replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]));}