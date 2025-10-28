// Guide and Porter Selection Enhancement
document.addEventListener('DOMContentLoaded', function() {
    const guideSelect = document.getElementById('guide_id');
    const porterSelect = document.getElementById('porter_id');
    const lengthOfStayInputs = document.querySelectorAll('input[name="length_of_stay"]');
    
    // Handle guide selection
    if (guideSelect) {
        guideSelect.addEventListener('change', function() {
            displayGuideDetails(this.value);
        });
    }
    
    // Handle porter selection
    if (porterSelect) {
        porterSelect.addEventListener('change', function() {
            displayPorterDetails(this.value);
        });
    }
    
    // Handle length of stay changes to show/hide porter recommendation
    lengthOfStayInputs.forEach(input => {
        input.addEventListener('change', function() {
            togglePorterRecommendation(this.value);
        });
    });

    function displayGuideDetails(guideId) {
        const guideCard = document.getElementById('guide-details-card');
        
        if (!guideId) {
            guideCard.classList.add('d-none');
            return;
        }
        
        const selectedOption = guideSelect.querySelector(`option[value="${guideId}"]`);
        if (!selectedOption) return;
        
        // Extract guide information from the option
        const guideName = selectedOption.textContent.split(' (')[0].trim();
        const totalTreks = selectedOption.dataset.totalTreks || 'N/A';
        const specializations = selectedOption.dataset.specializations || '';
        const contact = selectedOption.dataset.contact || 'N/A';
        const experience = selectedOption.dataset.experience || 'N/A';
        
        // Populate the card with guide details
        document.getElementById('guide-name').textContent = guideName;
        document.getElementById('guide-total-treks').textContent = totalTreks + ' treks';
        document.getElementById('guide-contact').textContent = contact;
        document.getElementById('guide-experience').textContent = experience + ' years';
        
        // Handle specializations
        const specializationsContainer = document.getElementById('guide-specializations-container');
        if (specializations && specializations.trim() !== '') {
            document.getElementById('guide-specializations').textContent = specializations;
            specializationsContainer.style.display = 'block';
        } else {
            specializationsContainer.style.display = 'none';
        }
        
        // Show the card with animation
        guideCard.classList.remove('d-none');
        guideCard.style.opacity = '0';
        guideCard.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
            guideCard.style.transition = 'all 0.3s ease';
            guideCard.style.opacity = '1';
            guideCard.style.transform = 'translateY(0)';
        }, 10);
    }

    function displayPorterDetails(porterId) {
        const porterCard = document.getElementById('porter-details-card');
        
        if (!porterId) {
            porterCard.classList.add('d-none');
            return;
        }
        
        const selectedOption = porterSelect.querySelector(`option[value="${porterId}"]`);
        if (!selectedOption) return;
        
        // Extract porter information from the option
        const porterName = selectedOption.textContent.split(' (')[0].trim();
        const capacity = selectedOption.dataset.capacity || 'N/A';
        const totalTreks = selectedOption.dataset.totalTreks || 'N/A';
        const contact = selectedOption.dataset.contact || 'N/A';
        const experience = selectedOption.dataset.experience || 'N/A';
        
        // Populate the card with porter details
        document.getElementById('porter-name').textContent = porterName;
        document.getElementById('porter-capacity').textContent = capacity + ' kg';
        document.getElementById('porter-total-treks').textContent = totalTreks + ' treks';
        document.getElementById('porter-contact').textContent = contact;
        document.getElementById('porter-experience').textContent = experience + ' years';
        
        // Show the card with animation
        porterCard.classList.remove('d-none');
        porterCard.style.opacity = '0';
        porterCard.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
            porterCard.style.transition = 'all 0.3s ease';
            porterCard.style.opacity = '1';
            porterCard.style.transform = 'translateY(0)';
        }, 10);
    }
    
    function togglePorterRecommendation(lengthOfStay) {
        const porterSection = document.getElementById('porter-selection');
        const porterLabel = porterSection.querySelector('label');
        
        if (lengthOfStay === 'overnight') {
            porterLabel.innerHTML = `
                Select Porter
                <span class="text-warning">(Highly Recommended for overnight treks)</span>
            `;
            porterSection.classList.add('border-warning', 'rounded', 'p-3');
        } else {
            porterLabel.innerHTML = `
                Select Porter
                <span class="text-muted">(Optional - Recommended for overnight treks)</span>
            `;
            porterSection.classList.remove('border-warning', 'rounded', 'p-3');
        }
    }
});