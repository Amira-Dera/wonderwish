/** Original light/particle treatment. No dependency, cursor replacement, or commerce logic. */
(() => {
	'use strict';
	const reduce = matchMedia('(prefers-reduced-motion: reduce)');
	const fine = matchMedia('(hover: hover) and (pointer: fine)');
	document.querySelectorAll('.ww-magic-hero').forEach((hero) => {
		const canvas = hero.querySelector('.ww-magic-canvas');
		const ctx = canvas?.getContext('2d');
		if (!ctx) return;
		const colors = ['#ffffff', '#d0f5ff', '#a4d8ff', '#e2eaf5'];
		const pool = Array.from({ length: 96 }, () => ({ active: false }));
		const trail = Array.from({ length: 80 }, () => ({ time: -Infinity, x: 0, y: 0 }));
		let width = 0, height = 0, rect, frame = 0, last = 0, elapsed = 0;
		let introDone = false, initialized = false, destroyed = false;
		let trailIndex = 0, particleIndex = 0, pointerDebt = 0, introDebt = 0;
		let pointerInside = false, px = 0, py = 0, lastX = 0, lastY = 0;
		let lastPointerAt = -Infinity;
		const setState = (state) => { if (hero.dataset.magicState !== state) hero.dataset.magicState = state; };
		const size = () => {
			rect = hero.getBoundingClientRect();
			width = rect.width; height = rect.height;
			const dpr = Math.min(devicePixelRatio || 1, fine.matches ? 1.5 : 1);
			canvas.width = Math.round(width * dpr); canvas.height = Math.round(height * dpr);
			ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
		};
		const resetParticles = () => { pool.forEach((p) => { p.active = false; }); trail.forEach((p) => { p.time = -Infinity; }); ctx.clearRect(0, 0, width, height); };
		const emit = (x, y, intro = false) => {
			const p = pool[particleIndex++ % pool.length];
			Object.assign(p, { active: true, x, y, vx: (Math.random() - .5) * .045, vy: .008 + Math.random() * .025, age: 0, life: 380 + Math.random() * (intro ? 420 : 620), radius: .8 + Math.random() * (intro ? 2.1 : 2.4), alpha: .75 + Math.random() * .25, color: colors[Math.floor(Math.random() * colors.length)], star: Math.random() > .55 });
		};
		const orbit = (t) => {
			const eased = t * t * (3 - 2 * t);
			const angle = -Math.PI + eased * Math.PI * 2.12;
			return { x: width * (.5 + .435 * Math.cos(angle)), y: height * (.57 + .31 * Math.sin(angle) - .035 * Math.sin(2 * angle)) };
		};
		const render = (now) => {
			frame = 0;
			if (destroyed || reduce.matches || document.hidden) return;
			const dt = last ? Math.min(now - last, 40) : 16;
			last = now; elapsed += dt;
			ctx.clearRect(0, 0, width, height);
			let busy = false;
			if (!introDone) {
				setState('intro');
				const t = Math.min(Math.max((elapsed - 120) / 2100, 0), 1);
				const tip = orbit(t);
				if (elapsed >= 120 && elapsed <= 2220) {
					Object.assign(trail[trailIndex++ % trail.length], { ...tip, time: elapsed });
					introDebt += dt;
					const interval = fine.matches && width > 900 ? 14 : 30;
					while (introDebt >= interval) { emit(tip.x + (Math.random() - .5) * 12, tip.y + (Math.random() - .5) * 12, true); introDebt -= interval; }
					const glow = ctx.createRadialGradient(tip.x, tip.y, 0, tip.x, tip.y, 22);
					glow.addColorStop(0, '#ffffff'); glow.addColorStop(.15, '#f1fcffff'); glow.addColorStop(.4, '#b2eaff70'); glow.addColorStop(1, '#b2eaff00');
					ctx.fillStyle = glow; ctx.fillRect(tip.x - 22, tip.y - 22, 44, 44);
				}
				if (elapsed >= 2220) {
					introDone = true; hero.dataset.introPlayed = 'true';
					for (let i = 0; i < (fine.matches ? 8 : 3); i++) emit(tip.x, tip.y, true);
				}
				busy = true;
			}
			// Fixed ring of short-lived line segments; no endless orbit.
			for (let i = 1; i < trail.length; i++) {
				const a = trail[(trailIndex + i - 1) % trail.length], b = trail[(trailIndex + i) % trail.length];
				const age = elapsed - b.time;
				if (age > 650 || age < 0 || !Number.isFinite(a.time) || b.time < a.time) continue;
				ctx.globalAlpha = (1 - age / 650) * .2; ctx.strokeStyle = '#a1ddff'; ctx.lineWidth = 4;
				ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y); ctx.stroke();
				ctx.globalAlpha = (1 - age / 650) * .85; ctx.strokeStyle = '#ecfbff'; ctx.lineWidth = 1.3;
				ctx.stroke(); busy = true;
			}
			ctx.globalAlpha = 1;
			// At most 45 emission steps/sec, two scattered particles per step, fixed pool.
			if (introDone && pointerInside && fine.matches && now - lastPointerAt < 90) {
				const distance = Math.hypot(px - lastX, py - lastY);
				pointerDebt = Math.min(pointerDebt + dt, 80);
				if (distance > 1.5 && pointerDebt >= 22) {
					const count = Math.min(3, Math.floor(pointerDebt / 22));
					for (let i = 1; i <= count; i++) {
						const x = lastX + (px - lastX) * i / count, y = lastY + (py - lastY) * i / count;
						emit(x, y); emit(x + (Math.random() - .5) * 14, y + (Math.random() - .5) * 14);
					}
					pointerDebt %= 22; lastX = px; lastY = py;
				}
				busy = true;
			}
			pool.forEach((p) => {
				if (!p.active) return;
				p.age += dt;
				if (p.age >= p.life) { p.active = false; return; }
				p.x += p.vx * dt; p.y += p.vy * dt;
				const remaining = 1 - p.age / p.life;
				const r = p.radius * (.3 + remaining * .7);
				const opacity = p.alpha * Math.pow(remaining, 1.4);
				if (p.star) {
					const glow = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, r * 5);
					glow.addColorStop(0, '#d9f7ff80'); glow.addColorStop(1, '#b2eaff00');
					ctx.globalAlpha = opacity; ctx.fillStyle = glow; ctx.fillRect(p.x - r * 5, p.y - r * 5, r * 10, r * 10);
				}
				ctx.globalAlpha = opacity; ctx.fillStyle = p.color;
				ctx.beginPath(); ctx.arc(p.x, p.y, r, 0, Math.PI * 2); ctx.fill();
				if (p.star) {
					ctx.beginPath(); ctx.moveTo(p.x, p.y - r * 3.4);
					ctx.lineTo(p.x + r * .45, p.y - r * .45); ctx.lineTo(p.x + r * 3.4, p.y);
					ctx.lineTo(p.x + r * .45, p.y + r * .45); ctx.lineTo(p.x, p.y + r * 3.4);
					ctx.lineTo(p.x - r * .45, p.y + r * .45); ctx.lineTo(p.x - r * 3.4, p.y);
					ctx.lineTo(p.x - r * .45, p.y - r * .45); ctx.closePath(); ctx.fill();
				}
				busy = true;
			});
			ctx.globalAlpha = 1;
			if (busy) frame = requestAnimationFrame(render);
			else { last = 0; setState('idle'); }
		};
		const wake = () => { if (!frame && !reduce.matches && !document.hidden && !destroyed) { last = 0; frame = requestAnimationFrame(render); } };
		const move = (event) => {
			if (event.pointerType === 'touch' || !fine.matches || reduce.matches || !introDone) return;
			rect = hero.getBoundingClientRect();
			px = event.clientX - rect.left; py = event.clientY - rect.top;
			if (!pointerInside) { lastX = px; lastY = py; pointerDebt = 22; }
			pointerInside = true; lastPointerAt = performance.now(); setState('pointer'); wake();
		};
		const leave = () => { pointerInside = false; pointerDebt = 0; };
		const preference = () => {
			leave(); cancelAnimationFrame(frame); frame = 0; last = 0;
			resetParticles();
			if (reduce.matches) { introDone = true; setState('reduced'); }
			else { size(); if (!initialized) initialized = true; wake(); }
		};
		const visibility = () => { if (document.hidden) { cancelAnimationFrame(frame); frame = 0; last = 0; leave(); } else wake(); };
		const resize = new ResizeObserver(() => { size(); if (!reduce.matches) wake(); });
		resize.observe(hero); size(); preference();
		hero.addEventListener('pointermove', move, { passive: true }); hero.addEventListener('pointerleave', leave);
		reduce.addEventListener('change', preference); fine.addEventListener('change', preference);
		document.addEventListener('visibilitychange', visibility);
		const exit = (event) => {
			if (event.persisted) { visibility(); return; }
			destroyed = true; cancelAnimationFrame(frame); resize.disconnect();
			hero.removeEventListener('pointermove', move); hero.removeEventListener('pointerleave', leave);
			reduce.removeEventListener('change', preference); fine.removeEventListener('change', preference);
			document.removeEventListener('visibilitychange', visibility);
			removeEventListener('pagehide', exit);
		};
		addEventListener('pagehide', exit);
	});
})();
