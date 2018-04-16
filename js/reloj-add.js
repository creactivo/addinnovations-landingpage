const getRemainTime = deadline => {
	let now = new Date(),
		remainTime = (new Date(deadline) - now + 1000)/1000,
		remainSeconds = ('0' + Math.floor(remainTime % 60)).slice(-2),
		remainMinutes = ('0' + Math.floor(remainTime / 60 % 60)).slice(-2),
		remainHours = ('0' + Math.floor(remainTime / 3600 % 24)).slice(-2),
		remainDays = Math.floor(remainTime / (3600 * 24));
	

	return {
		remainTime,
		remainSeconds,
		remainMinutes,
		remainHours,
		remainDays
	}
};

const countdown = (deadline, elem, finalMassage) => {
	const el = document.getElementById(elem);

	const timerUpdate = setInterval(() => {
		let t = getRemainTime(deadline);
		el.innerHTML = `${t.remainDays} dias ${t.remainHours} horas ${t.remainMinutes} minutos ${t.remainSeconds} segundos`;
	

	if (t.remainTime <= 1){
		clearInterval(timerUpdate);
		el.innerHTML = finalMassage;
	}
	}, 1000)

};
countdown('May 02 2018 16:10:02 GMT-0500','clock', 'feliz dia');

